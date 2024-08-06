<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $enrolledCourses = $user->enrolledCourses()->paginate(5);
        $completedCourses = $user->enrolledCourses()->whereHas('progress', function ($query) use ($user) {
            $query->where('user_id', $user->id)->where('completed', true);
        })->paginate(5);

        if ($user->isInstructor()) {
            $instructedCourses = $user->instructedCourses()->paginate(5);
            $totalStudents = $user->instructedCourses()->withCount('students')->get()->sum('students_count');
            $totalRevenue = $user->instructedCourses()->sum('price');

            return view('dashboard.instructor', compact('user', 'enrolledCourses', 'completedCourses', 'instructedCourses', 'totalStudents', 'totalRevenue'));
        }

        return view('dashboard.student', compact('user', 'enrolledCourses', 'completedCourses'));
    }
}
