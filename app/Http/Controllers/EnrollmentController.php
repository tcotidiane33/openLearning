<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function enroll(Course $course)
    {
        if (Auth::user()->enrolledCourses()->where('course_id', $course->id)->exists()) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

        Auth::user()->enrolledCourses()->attach($course);

        return redirect()->route('courses.show', $course)->with('success', 'Successfully enrolled in the course.');
    }

    public function unenroll(Course $course)
    {
        Auth::user()->enrolledCourses()->detach($course);

        return redirect()->route('courses.show', $course)->with('success', 'Successfully unenrolled from the course.');
    }
}
