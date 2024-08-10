<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
    $this->middleware(function ($request, $next) {
        if (auth()->user()->role !== 'instructor') {
            abort(403, 'Only instructors can access this page.');
        }
        return $next($request);
    });
}
    public function index(Request $request)
    {
        $query = Course::where('is_published', true);

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $query->orderBy($sortField, $sortDirection);

        $courses = $query->paginate(12);
        $categories = Category::all();

        return view('courses.index', compact('courses', 'categories'));
    }

    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    public function create()
    {
        // $this->authorize('create', Course::class);
        $this->authorize('create courses');
        $categories = Category::all();
        return view('courses.create', compact('categories'));
    }

    public function store(Request $request)
{
    $this->authorize('create', Course::class);

    if (Gate::denies('manage-courses')) {
        abort(403);
    }

    $validated = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'estimated_duration' => 'required|string',
    ]);

    $course = Auth::user()->instructedCourses()->create($validated);

    return redirect()->route('courses.show', $course)->with('success', 'Course created successfully.');
}

    public function edit(Course $course)
    {
        // $this->authorize('update', $course);
        $this->authorize('edit courses');
        $categories = Category::all();
        return view('courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        $this->authorize('update', $course);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'estimated_duration' => 'required|string',
        ]);

        $course->update($validated);

        return redirect()->route('courses.show', $course)->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);

        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
    
    public function storeRating(Request $request, Course $course)
{
    $validated = $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:1000', // Ajoutez cette ligne si vous voulez permettre des commentaires optionnels
    ]);

    $review = $course->reviews()->updateOrCreate(
        ['user_id' => Auth::id()],
        [
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null, // Ajoutez cette ligne si vous incluez des commentaires
        ]
    );

    $course->updateAverageRating();

    return back()->with('success', 'Rating added successfully');
}
public function instructorCourses()
{
    $courses = auth()->user()->instructedCourses()->paginate(10);
    return view('instructor.courses', compact('courses'));
}

    public function storeReview(Request $request, Course $course)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review = $course->reviews()->updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'rating' => $validated['rating'],
                'comment' => $validated['comment']
            ]
        );

        $course->updateAverageRating();

        return back()->with('success', 'Review added successfully');
    }
}