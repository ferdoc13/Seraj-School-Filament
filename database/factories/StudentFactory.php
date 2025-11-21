<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Level;
use App\Enums\Students\StudentField;
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
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'level_id' => Level::inRandomOrder()->first()->id,
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'national_code' => fake()->unique()->nationalCode(),
            'status' => fake()->boolean(),
            'field' => fake()->randomElement(StudentField::cases()),
            'birth_date' => fake()->date(),
        ];
    }
}
