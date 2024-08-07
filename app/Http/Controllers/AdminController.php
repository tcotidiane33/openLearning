<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users()
    {
        $users = User::paginate(20);
        return view('admin.users', compact('users'));
    }

    public function courses()
    {
        $courses = Course::with('instructor')->paginate(20);
        return view('admin.courses', compact('courses'));
    }

    public function reports()
    {
        // Ici, vous pouvez ajouter la logique pour générer des rapports généraux
        return view('admin.reports');
    }
}