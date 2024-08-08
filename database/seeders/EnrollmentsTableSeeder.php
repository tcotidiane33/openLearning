<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EnrollmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::where('role', 'student')->get();
        $courses = Course::all();

        foreach ($students as $student) {
            $coursesToEnroll = min($courses->count(), 3);  // Prend le minimum entre le nombre de cours disponibles et 3
            $enrolledCourses = $courses->random($coursesToEnroll);
            foreach ($enrolledCourses as $course) {
                Enrollment::updateOrCreate(
                    [
                        'user_id' => $student->id,
                        'course_id' => $course->id,
                    ],
                    [
                        'status' => 'active',
                    ]
                );
            }
        }
    }
}
