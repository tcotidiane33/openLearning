<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Lesson;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function show(Lesson $lesson, Quiz $quiz)
    {
        $this->authorize('view', $quiz);
        return view('quizzes.show', compact('lesson', 'quiz'));
    }

    public function create(Lesson $lesson)
    {
        $this->authorize('create', Quiz::class);
        return view('quizzes.create', compact('lesson'));
    }

    public function store(Request $request, Lesson $lesson)
    {
        $this->authorize('create', Quiz::class);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'questions' => 'required|array|min:1',
            'questions.*.content' => 'required|string',
            'questions.*.answers' => 'required|array|min:2',
            'questions.*.answers.*.content' => 'required|string',
            'questions.*.answers.*.is_correct' => 'required|boolean',
        ]);

        $quiz = $lesson->quiz()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        foreach ($validated['questions'] as $questionData) {
            $question = $quiz->questions()->create([
                'content' => $questionData['content'],
            ]);

            foreach ($questionData['answers'] as $answerData) {
                $question->answers()->create([
                    'content' => $answerData['content'],
                    'is_correct' => $answerData['is_correct'],
                ]);
            }
        }

        return redirect()->route('lessons.show', $lesson)->with('success', 'Quiz created successfully.');
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'exists:answers,id',
        ]);

        $score = 0;
        $totalQuestions = $quiz->questions->count();

        foreach ($quiz->questions as $question) {
            $userAnswer = $validated['answers'][$question->id] ?? null;
            $correctAnswer = $question->answers()->where('is_correct', true)->first();

            if ($userAnswer && $userAnswer == $correctAnswer->id) {
                $score++;
            }
        }

        $percentageScore = ($score / $totalQuestions) * 100;

        // Save the quiz result
        auth()->user()->quizResults()->create([
            'quiz_id' => $quiz->id,
            'score' => $score,
            'total_questions' => $totalQuestions,
        ]);

        return view('quizzes.results', compact('quiz', 'score', 'totalQuestions', 'percentageScore'));
    }
}
