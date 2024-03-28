<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Student;
use App\Models\StudentCourse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentCourse>
 */
class StudentCourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = StudentCourse::class;
    public function definition(): array
    {
        $courseIds = Course::pluck('course_id')->toArray();
        $studentIds = Student::pluck('std_id')->toArray();

        // Loop until a unique combination is found
        do {
            $courseId = $this->faker->randomElement($courseIds);
            $studentId = $this->faker->randomElement($studentIds);

            // Check if the combination already exists
            $existingRecord = StudentCourse::where('course_id', $courseId)
                ->where('student_id', $studentId)
                ->exists();
        } while ($existingRecord);

        // var_dump([$courseId, $studentId]);
        return [
            'course_id' => $courseId,
            'student_id' => $studentId,
            'status' => $this->faker->randomElement(['success', 'failed']),
        ];
    }
}
