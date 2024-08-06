<?php

class EnsureUserIsEnrolled
{
    public function handle($request, Closure $next, $courseId)
    {
        if (!auth()->user()->enrolledCourses->contains($courseId)) {
            abort(403, 'You are not enrolled in this course.');
        }

        return $next($request);
    }
}
