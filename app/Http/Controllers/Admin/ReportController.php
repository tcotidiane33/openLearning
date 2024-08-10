<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $totalRevenue = Enrollment::sum('price');
        $totalUsers = User::count();
        $totalCourses = Course::count();

        $revenueByMonth = Enrollment::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(price) as revenue')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->take(12)
            ->get();

        $topCourses = Course::withCount('enrollments')
            ->orderBy('enrollments_count', 'desc')
            ->take(5)
            ->get();

        return view('admin.reports.index', compact(
            'totalRevenue',
            'totalUsers',
            'totalCourses',
            'revenueByMonth',
            'topCourses'
        ));
    }
}