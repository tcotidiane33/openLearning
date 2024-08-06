<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function courseEnrollments(Course $course)
    {
        $this->authorize('viewReports', $course);

        $enrollments = $course->enrollments()
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('reports.course-enrollments', compact('course', 'enrollments'));
    }

    public function courseRevenue(Course $course)
    {
        $this->authorize('viewReports', $course);

        $revenue = $course->payments()
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amount) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('reports.course-revenue', compact('course', 'revenue'));
    }

    public function instructorDashboard()
    {
        $user = auth()->user();
        $this->authorize('viewInstructorDashboard', User::class);

        $totalStudents = $user->instructedCourses()->withCount('students')->get()->sum('students_count');
        $totalRevenue = $user->instructedCourses()->sum('price');
        $courseEnrollments = $user->instructedCourses()->withCount('students')->orderByDesc('students_count')->take(5)->get();
        $recentReviews = $user->instructedCourses()->with('reviews')->take(5)->get()->pluck('reviews')->flatten();

        return view('reports.instructor-dashboard', compact('user', 'totalStudents', 'totalRevenue', 'courseEnrollments', 'recentReviews'));
    }

    public function adminDashboard()
    {
        $this->authorize('viewAdminDashboard', User::class);

        $totalUsers = User::count();
        $totalCourses = Course::count();
        $totalRevenue = DB::table('payments')->sum('amount');
        $recentEnrollments = DB::table('enrollments')
            ->join('users', 'enrollments.user_id', '=', 'users.id')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->select('users.name as user_name', 'courses.title as course_title', 'enrollments.created_at')
            ->orderByDesc('enrollments.created_at')
            ->take(10)
            ->get();

        return view('reports.admin-dashboard', compact('totalUsers', 'totalCourses', 'totalRevenue', 'recentEnrollments'));
    }
}
