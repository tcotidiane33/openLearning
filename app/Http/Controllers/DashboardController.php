<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $enrolledCourses = $user->enrolledCourses()->paginate(5);
        
        // Récupérer les IDs des leçons complétées
        $completedLessonIds = $user->progress()
            ->where('completed', true)
            ->pluck('lesson_id');
        
        // Récupérer les cours qui ont toutes leurs leçons complétées
        $completedCourses = $user->enrolledCourses()
            ->whereDoesntHave('lessons', function ($query) use ($completedLessonIds) {
                $query->whereNotIn('id', $completedLessonIds);
            })
            ->paginate(5);
    
        if ($user->isInstructor()) {
            $instructedCourses = $user->instructedCourses()->paginate(5);
            $totalStudents = $user->instructedCourses()->withCount('students')->get()->sum('students_count');
            $totalRevenue = $user->instructedCourses()->sum('price');
    
            return view('dashboard.instructor', compact('user', 'enrolledCourses', 'completedCourses', 'instructedCourses', 'totalStudents', 'totalRevenue'));
        }
    
        return view('dashboard.student', compact('user', 'enrolledCourses', 'completedCourses'));
    }
}
