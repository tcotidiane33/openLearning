<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(Request $request)
{
    $query = Course::query();

    if ($request->has('category')) {
        $query->where('category_id', $request->category);
    }

    if ($request->has('level')) {
        $query->where('level', $request->level);
    }

    $sortField = $request->get('sort', 'created_at');
    $sortDirection = $request->get('direction', 'desc');
    $query->orderBy($sortField, $sortDirection);

    $courses = $query->paginate(15);

    return view('courses.index', compact('courses'));
}
    public function show(Course $course, Lesson $lesson)
    {
        $this->authorize('view', $lesson);
        return view('lessons.show', compact('course', 'lesson'));
    }

    public function create(Course $course)
    {
        $this->authorize('create', Lesson::class);
        return view('lessons.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $this->authorize('create', Lesson::class);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'order' => 'required|integer|min:1',
        ]);

        $lesson = $course->lessons()->create($validated);

        return redirect()->route('courses.show', $course)->with('success', 'Lesson created successfully.');
    }

    public function edit(Course $course, Lesson $lesson)
    {
        $this->authorize('update', $lesson);
        return view('lessons.edit', compact('course', 'lesson'));
    }

    public function update(Request $request, Course $course, Lesson $lesson)
    {
        $this->authorize('update', $lesson);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'order' => 'required|integer|min:1',
        ]);

        $lesson->update($validated);

        return redirect()->route('courses.show', $course)->with('success', 'Lesson updated successfully.');
    }

    public function destroy(Course $course, Lesson $lesson)
    {
        $this->authorize('delete', $lesson);

        $lesson->delete();

        return redirect()->route('courses.show', $course)->with('success', 'Lesson deleted successfully.');
    }
}
