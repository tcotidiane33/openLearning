<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Review;
use App\Models\Payment;
use App\Models\Enrollment;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function adminDashboard()
    {
        $this->authorize('viewAdminDashboard', User::class);

        $totalUsers = User::count();
        $totalCourses = Course::count();
        $totalRevenue = Payment::sum('amount');
        $recentEnrollments = Enrollment::with(['user', 'course'])
            ->latest()
            ->take(10)
            ->get();

        return view('reports.admin-dashboard', compact('totalUsers', 'totalCourses', 'totalRevenue', 'recentEnrollments'));
    }

    public function instructorDashboard()
    {
        $user = Auth::user();
        $courses = $user->instructedCourses()->withCount('students')->get();
        $totalStudents = $courses->sum('students_count');
        $totalRevenue = $courses->sum('revenue');
        $latestAnnouncement = Announcement::getLatestPublished();
    
        // Récupérer les inscriptions récentes pour tous les cours de l'instructeur
        $recentEnrollments = $courses->map(function ($course) {
            return [
                'course' => $course,
                'enrollments' => $course->enrollments()
                    ->with('user')
                    ->latest()
                    ->take(5)
                    ->get()
            ];
        })->filter(function ($item) {
            return $item['enrollments']->isNotEmpty();
        });
    
        return view('instructor.dashboard', compact(
            'user', 
            'courses', 
            'totalStudents', 
            'totalRevenue', 
            'latestAnnouncement', 
            'recentEnrollments'
        ));
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

    // public function studentDashboard()
    // {
    //     // Logique pour le tableau de bord étudiant
    //     return view('student.dashboard', compact('data'));
    // }
}