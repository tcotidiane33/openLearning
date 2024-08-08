<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\User;
use App\Models\Category;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructors = User::where('role', 'instructor')->get();
        $categories = Category::all();

        foreach ($instructors as $instructor) {
            for ($i = 0; $i < 3; $i++) {  // Crée 3 cours par instructeur
                Course::create([
                    'title' => "Course $i by " . $instructor->name,
                    'description' => 'This is a sample course description.',
                    'instructor_id' => $instructor->id,
                    'category_id' => $categories->random()->id,
                    'price' => rand(10, 100),
                    'is_published' => true,
                    'featured' => rand(0, 1),
                    'level' => ['Beginner', 'Intermediate', 'Advanced'][rand(0, 2)],
                    'subject' => 'Sample Subject',
                ]);
            }
        }
    }
}
