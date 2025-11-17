<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CourseTableSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        DB::table('courses')->insert([
            [
                'user_id' => 1,
                'name' => 'Laravel Basics for Beginners',
                'category' => 'Web Development',
                'cover_image' => '1.jpg', // simulate uploaded filename
                'type' => 'course',
                'duration' => '5 hours',
                'level' => 'Beginner',
                'lectures' => 15,
                'language' => 'English',
                'price' => 49.99,
                'details' => 'Learn the fundamentals of Laravel 12 and build your first web app.',
                'course_file' => '1.zip',
                'created_at' => $now,
            ],
            [
                'user_id' => 2,
                'name' => 'Advanced TailwindCSS Design',
                'category' => 'Frontend Design',
                'cover_image' => '2.jpg',
                'type' => 'course',
                'duration' => '8 hours',
                'level' => 'Advanced',
                'lectures' => 25,
                'language' => 'English',
                'price' => 79.99,
                'details' => 'Master TailwindCSS and create responsive, modern web designs.',
                'course_file' => '2.zip',
                'created_at' => $now,
            ],
            [
                'user_id' => 1,
                'name' => 'PHP OOP and MVC',
                'category' => 'Backend Development',
                'cover_image' => '3.jpg',
                'type' => 'course',
                'duration' => '6 hours',
                'level' => 'Intermediate',
                'lectures' => 18,
                'language' => 'English',
                'price' => 59.99,
                'details' => 'Learn Object-Oriented PHP and MVC architecture for real-world projects.',
                'course_file' => '3.zip',
                'created_at' => $now,
            ],
            [
                'user_id' => 3,
                'name' => 'ReactJS Crash Course',
                'category' => 'Frontend Development',
                'cover_image' => '4.jpg',
                'type' => 'course',
                'duration' => '7 hours',
                'level' => 'Beginner',
                'lectures' => 20,
                'language' => 'English',
                'price' => 69.99,
                'details' => 'Get started with ReactJS by building interactive web applications.',
                'course_file' => '4.zip',
                'created_at' => $now,
            ],
        ]);
    }
}
