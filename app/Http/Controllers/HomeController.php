<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('student')) {
                return $this->studentDashboard();
            } elseif (Auth::user()->hasRole('instructor')) {
                return $this->instructorDashboard();
            } elseif (Auth::user()->hasRole('admin')) {
                return $this->adminDashboard();
            }
        }
        return $this->guestHome();
    }

    private function studentDashboard()
    {
        $enrolledCourses = Auth::user()->enrolledCourses()->get();
        $recommendedCourses = Course::inRandomOrder()->limit(4)->get();
        return view('home', compact('enrolledCourses', 'recommendedCourses'));
    }

    private function instructorDashboard()
    {
        $courses = Auth::user()->courses()->withCount('students')->get();
        return view('home', compact('courses'));
    }

    private function adminDashboard()
    {
        $courses = Course::withCount('students')->get();
        $users = User::count();
        return view('home', compact('courses', 'users'));
    }

    private function guestHome()
    {
        $featuredCourses = Course::where('featured', true)->take(4)->get();
        // $featuredCourses = Course::orderBy('created_at', 'desc')->take(4)->get();
        $categories = Category::withCount('courses')->get();
        return view('home', compact('featuredCourses', 'categories'));
    }
}
