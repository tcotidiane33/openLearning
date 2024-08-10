<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalCourses = Course::count();
        $totalRevenue = Payment::sum('amount');
        // $totalPrice = Course::sum('price'); // ou le nom correct de la colonne
        $totalPrice = Course::withCount('students')
            ->get()
            ->sum(function ($course) {
                return $course->price * $course->students_count;
            });
        $totalEnrollments = Enrollment::count();

        $recentUsers = User::latest()->take(5)->get();
        $recentCourses = Course::with('instructor')->latest()->take(5)->get();

        $monthlyRevenue = Payment::select(
            DB::raw('sum(amount) as revenue'),
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
        )
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->take(12)
            ->get();

        $userGrowth = User::select(
            DB::raw('count(*) as total'),
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
        )
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->take(12)
            ->get();

        // Ajoutez cette ligne pour définir $courses
        $courses = Course::withCount('students')->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalCourses',
            'totalRevenue',
            'totalPrice',
            'totalEnrollments',
            'recentUsers',
            'recentCourses',
            'monthlyRevenue',
            'userGrowth',
            'courses',
        ));
    }
}