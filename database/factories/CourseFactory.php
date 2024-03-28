<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Course::class;
    public function definition(): array
    {
        return [
            'course_id' => $this->faker->unique()->randomNumber(),
            'name' => $this->faker->unique()->sentence(2),
            'weight' => $this->faker->numberBetween(1, 4),
        ];
    }
}
