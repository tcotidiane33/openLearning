<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
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
