<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Models\Announcement;
use App\Models\Enrollment;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return $this->dashboard();
        }
        return $this->guestHome();
    }

    public function dashboard()
    {
        $user = Auth::user();
        if ($user->hasRole('student')) {
            return $this->studentDashboard();
        } elseif ($user->hasRole('instructor')) {
            return $this->instructorDashboard();
        } elseif ($user->hasRole('admin')) {
            return $this->adminDashboard();
        }
        return redirect()->route('home');
    }

    public function studentDashboard()
    {
        $user = Auth::user();
        $enrolledCourses = $user->enrolledCourses()->get();
        $recommendedCourses = Course::inRandomOrder()->limit(4)->get();
        $latestAnnouncement = Announcement::latest()->first();
        $completedCourses = $enrolledCourses->where('user_progress', 100);
        $completedCoursesCount = $completedCourses->count();
        $totalLearningTime = $enrolledCourses->sum('total_duration');
        $certificatesCount = $user->certificates()->count();

        return view('student.dashboard', compact(
            'enrolledCourses',
            'recommendedCourses',
            'latestAnnouncement',
            'completedCourses',
            'completedCoursesCount',
            'totalLearningTime',
            'certificatesCount'
        ));
    }

    public function instructorDashboard()
    {
        $user = Auth::user();
        $courses = $user->instructedCourses()->withCount('students')->get();
        $totalStudents = $courses->sum('students_count');
        $totalRevenue = $courses->sum('revenue');
        $latestAnnouncement = Announcement::getLatestPublished();
        $recentEnrollments = $courses->flatMap(function ($course) {
            return $course->enrollments()->with('user')->latest()->take(5)->get();
        })->sortByDesc('created_at')->take(10);

        return view('instructor.dashboard', compact(
            'user',
            'courses',
            'totalStudents',
            'totalRevenue',
            'latestAnnouncement',
            'recentEnrollments'
        ));
    }
    public function adminDashboard()
    {
        $dashboardController = new \App\Http\Controllers\Admin\DashboardController();
        return $dashboardController->index();
    }

    private function guestHome()
    {
        $featuredCourses = Course::where('featured', true)->take(4)->get();
        $categories = Category::withCount('courses')->get();
        $courses = Course::all();
        $latestAnnouncement = Announcement::getLatestPublished();

        return view('home', compact('featuredCourses', 'categories', 'courses', 'latestAnnouncement'));
    }
}