<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function getQuiz(Lesson $lesson)
    {
        $quiz = $lesson->quiz()->with('questions.answers')->first();

        if (!$quiz) {
            return response()->json(['message' => 'No quiz found for this lesson'], 404);
        }

        return response()->json($quiz);
    }

    public function submitQuiz(Request $request, Quiz $quiz)
    {
        $validatedData = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'exists:answers,id'
        ]);

        $score = 0;
        $totalQuestions = $quiz->questions->count();

        foreach ($quiz->questions as $question) {
            $userAnswerId = $validatedData['answers'][$question->id] ?? null;
            $correctAnswer = $question->answers()->where('is_correct', true)->first();

            if ($userAnswerId && $userAnswerId == $correctAnswer->id) {
                $score++;
            }
        }

        $percentageScore = ($score / $totalQuestions) * 100;

        // Save the quiz result
        $quizResult = $request->user()->quizResults()->create([
            'quiz_id' => $quiz->id,
            'score' => $score,
            'total_questions' => $totalQuestions,
            'percentage_score' => $percentageScore
        ]);

        return response()->json([
            'quiz_result' => $quizResult,
            'message' => 'Quiz submitted successfully'
        ]);
    }
}
