<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Student::class;
    public function definition(): array
    {
        return [
            'std_id' => $this->faker->unique()->randomNumber(),
            'name' => $this->faker->unique()->name(),
            'password' => $this->faker->password(),
            'email' => $this->faker->unique()->email(),
        ];
    }
}
