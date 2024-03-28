<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Course;
use App\Models\Student;
use App\Models\StudentCourse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // Student::create([
        //     'name' => 'Mohmmad Naser',
        //     'email' => 'mhmd@gmail.com',
        //     'std_id' => '12029911',
        //     'password' => Hash::make('147369258'),
        // ]);
        // Student::create([
        //     'name' => 'Jana Taha',
        //     'email' => 'jana@gmail.com',
        //     'std_id' => '12010027',
        //     'password' => Hash::make('123456789'),
        // ]);
        // Course::factory(30)->create();
        StudentCourse::factory(30)->create();
    }
}
