<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function enroll(Request $request, Course $course)
    {
        $user = $request->user();

        if ($user->enrolledCourses->contains($course)) {
            return response()->json(['message' => 'Already enrolled in this course'], 400);
        }

        $user->enrolledCourses()->attach($course);

        return response()->json(['message' => 'Successfully enrolled in the course']);
    }

    public function unenroll(Request $request, Course $course)
    {
        $user = $request->user();

        if (!$user->enrolledCourses->contains($course)) {
            return response()->json(['message' => 'Not enrolled in this course'], 400);
        }

        $user->enrolledCourses()->detach($course);

        return response()->json(['message' => 'Successfully unenrolled from the course']);
    }
}
