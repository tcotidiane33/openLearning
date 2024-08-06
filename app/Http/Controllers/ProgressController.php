<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Notifications\CourseCompleted;

class ProgressController extends Controller
{
    public function update(Request $request, Lesson $lesson)
    {
        $user = auth()->user();

        $progress = $user->progress()->updateOrCreate(
            ['lesson_id' => $lesson->id],
            ['completed' => true]
        );

        return response()->json(['success' => true, 'message' => 'Progress updated successfully']);
    }

    public function completeLesson(Request $request, Course $course, Lesson $lesson)
    {
        $user = auth()->user();

        // Logique pour marquer la leçon comme terminée
        $progress = $user->progress()->updateOrCreate(
            ['lesson_id' => $lesson->id],
            ['completed' => true]
        );

        // Vérifier si le cours est entièrement complété
        if ($this->isCourseCompleted($course, $user)) {
            $user->notify(new CourseCompleted($course));

            // Optionnel : Marquer le cours comme terminé dans une table séparée
            $user->completedCourses()->attach($course->id, ['completed_at' => now()]);
        }

        return redirect()->back()->with('success', 'Lesson completed!');
    }

    private function isCourseCompleted(Course $course, $user)
    {
        $totalLessons = $course->lessons()->count();
        $completedLessons = $user->progress()
            ->whereIn('lesson_id', $course->lessons()->pluck('id'))
            ->where('completed', true)
            ->count();

        return $totalLessons === $completedLessons;
    }
}
