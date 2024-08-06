<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function completeLesson(Request $request, Lesson $lesson)
    {
        $user = $request->user();

        $user->completedLessons()->syncWithoutDetaching([$lesson->id => ['completed_at' => now()]]);

        return response()->json(['message' => 'Lesson marked as completed']);
    }

    public function getCourseProgress(Request $request, Course $course)
    {
        $user = $request->user();

        $totalLessons = $course->lessons->count();
        $completedLessons = $user->completedLessons()->where('course_id', $course->id)->count();

        $progress = ($totalLessons > 0) ? ($completedLessons / $totalLessons) * 100 : 0;

        return response()->json([
            'total_lessons' => $totalLessons,
            'completed_lessons' => $completedLessons,
            'progress_percentage' => $progress
        ]);
    }
}
