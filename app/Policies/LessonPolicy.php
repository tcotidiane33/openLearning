<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\User;

class LessonPolicy
{
    public function view(User $user, Lesson $lesson)
    {
        return $user->enrolledCourses->contains($lesson->course_id);
    }
}