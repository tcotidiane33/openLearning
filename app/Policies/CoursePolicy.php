<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true; // Tout le monde peut voir la liste des cours
    }

    public function view(User $user, Course $course)
    {
        return $user->hasPermissionTo('view courses');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('create courses');
    }

    public function update(User $user, Course $course)
    {
        return $user->hasRole('admin') || ($user->hasPermissionTo('edit courses') && $user->id === $course->instructor_id);
    }

    public function delete(User $user, Course $course)
    {
        return $user->hasRole('admin') || ($user->hasPermissionTo('delete courses') && $user->id === $course->instructor_id);
    }
}