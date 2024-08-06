<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function show(Lesson $lesson)
    {
        return response()->json($lesson);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|max:255',
            'content' => 'required',
            // Add other necessary fields
        ]);

        $lesson = Lesson::create($validatedData);

        return response()->json($lesson, 201);
    }

    public function update(Request $request, Lesson $lesson)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            // Add other necessary fields
        ]);

        $lesson->update($validatedData);

        return response()->json($lesson);
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return response()->json(null, 204);
    }
}
