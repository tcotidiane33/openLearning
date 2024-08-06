<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    public function view(User $user, Course $course)
    {
        return $user->id === $course->instructor_id || $user->enrolledCourses->contains($course);
    }

    public function update(User $user, Course $course)
    {
        return $user->id === $course->instructor_id;
    }

    public function delete(User $user, Course $course)
    {
        return $user->id === $course->instructor_id;
    }

    public function createLesson(User $user, Course $course)
    {
        return $user->id === $course->instructor_id;
    }

    public function viewReports(User $user, Course $course)
    {
        return $user->id === $course->instructor_id || $user->hasRole('admin');
    }
}
