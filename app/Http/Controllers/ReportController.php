<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // public function courseEnrollments(Course $course)
    // {
    //     $this->authorize('viewReports', $course);

    //     $enrollments = $course->enrollments()
    //         ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
    //         ->groupBy('date')
    //         ->orderBy('date')
    //         ->get();

    //     return view('reports.course-enrollments', compact('course', 'enrollments'));
    // }

    // public function courseRevenue(Course $course)
    // {
    //     $this->authorize('viewReports', $course);

    //     $revenue = $course->payments()
    //         ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amount) as total'))
    //         ->groupBy('date')
    //         ->orderBy('date')
    //         ->get();

    //     return view('reports.course-revenue', compact('course', 'revenue'));
    // }

    public function instructorDashboard()
    {
        $user = auth()->user();
        $totalStudents = $user->instructedCourses()->withCount('students')->get()->sum('students_count');
        $totalRevenue = $user->instructedCourses()->sum('price');
        $recentEnrollments = $user->instructedCourses()->with('recentEnrollments')->get();
        
        return view('instructor.dashboard', compact('user', 'totalStudents', 'totalRevenue', 'recentEnrollments'));
    }
    
    public function courseEnrollments(Course $course)
    {
        $this->authorize('view', $course);
        $enrollments = $course->enrollments()->with('user')->paginate(20);
        return view('instructor.course-enrollments', compact('course', 'enrollments'));
    }
    
    public function courseRevenue(Course $course)
    {
        $this->authorize('view', $course);
        $revenue = $course->enrollments()->sum('price');
        $monthlyRevenue = $course->enrollments()
            ->selectRaw('YEAR(created_at) year, MONTH(created_at) month, SUM(price) total')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
        
        return view('instructor.course-revenue', compact('course', 'revenue', 'monthlyRevenue'));
    }
    
    public function adminDashboard()
    {
        $totalUsers = User::count();
        $totalCourses = Course::count();
        $totalRevenue = Course::sum('price');
        $recentEnrollments = Enrollment::with(['user', 'course'])->latest()->take(10)->get();
        
        return view('admin.dashboard', compact('totalUsers', 'totalCourses', 'totalRevenue', 'recentEnrollments'));
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

    public function instructorDashboard()
    {
        $user = auth()->user();

        // Calcul du nombre total d'étudiants
        $totalStudents = Enrollment::whereIn('course_id', $user->instructedCourses->pluck('id'))
                                   ->distinct('user_id')
                                   ->count();

        // Calcul du revenu total
        $totalRevenue = Enrollment::whereIn('course_id', $user->instructedCourses->pluck('id'))
                                  ->sum('price');

        // Cours les plus populaires
        $courseEnrollments = $user->instructedCourses()
                                  ->withCount('students')
                                  ->orderByDesc('students_count')
                                  ->take(5)
                                  ->get();

        // Avis récents
        $recentReviews = Review::whereIn('course_id', $user->instructedCourses->pluck('id'))
                               ->with(['user', 'course'])
                               ->latest()
                               ->take(5)
                               ->get();

        // Calcul des revenus mensuels
        $monthlyRevenue = Enrollment::whereIn('course_id', $user->instructedCourses->pluck('id'))
                                    ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, SUM(price) total'))
                                    ->groupBy('year', 'month')
                                    ->orderBy('year', 'desc')
                                    ->orderBy('month', 'desc')
                                    ->take(12)
                                    ->get();

        return view('reports.instructor-dashboard', compact(
            'totalStudents',
            'totalRevenue',
            'courseEnrollments',
            'recentReviews',
            'monthlyRevenue'
        ));
    }
}
