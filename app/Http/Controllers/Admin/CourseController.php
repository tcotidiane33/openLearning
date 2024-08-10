<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with('instructor', 'category');

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $courses = $query->paginate(15);

        return view('admin.courses.index', compact('courses'));
    }

    public function edit(Course $course)
    {
        
        $categories = Category::all();
        return view('admin.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    public function toggleApproval(Course $course)
    {
        $course->update(['is_approved' => !$course->is_approved]);
        return back()->with('success', 'Course approval status updated.');
    }

    public function toggleFeatured(Course $course)
    {
        $course->update(['is_featured' => !$course->is_featured]);
        return back()->with('success', 'Course featured status updated.');
    }
}