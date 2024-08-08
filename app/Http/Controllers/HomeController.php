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
    $user = auth()->user();
    
    if (!$user) {
        // L'utilisateur n'est pas connecté, afficher la page d'accueil pour les invités
        $featuredCourses = Course::where('featured', true)->take(4)->get();
        $categories = Category::withCount('courses')->get();
        return view('home', compact('featuredCourses', 'categories'));
    }

    if ($user->hasRole('student')) {
        $enrolledCourses = $user->enrolledCourses()->paginate(5);
        $recommendedCourses = Course::inRandomOrder()->take(4)->get();
        return view('home', compact('enrolledCourses', 'recommendedCourses'));
    } elseif ($user->hasRole('instructor')) {
        $courses = $user->instructedCourses()->withCount('students')->get();
        return view('home', compact('courses'));
    } elseif ($user->hasRole('admin')) {
        $courses = Course::withCount('students')->get();
        $users = User::count();
        return view('home', compact('courses', 'users'));
    }

    // Si l'utilisateur n'a aucun rôle spécifique, rediriger vers une page par défaut
    return redirect()->route('dashboard');
}
    public function authentificate()
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
