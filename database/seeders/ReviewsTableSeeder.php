<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::where('role', 'student')->get();
        $courses = Course::all();

        foreach ($courses as $course) {
            $reviewers = $students->random(rand(1, 5));
            foreach ($reviewers as $reviewer) {
                Review::create([
                    'user_id' => $reviewer->id,
                    'course_id' => $course->id,
                    'rating' => rand(1, 5),
                    'comment' => 'This is a sample review comment.',
                ]);
            }
        }
    }
}
