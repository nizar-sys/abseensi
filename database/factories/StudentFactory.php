<?php

namespace Database\Factories;

use App\Models\Rayon;
use App\Models\Rombel;
use App\Models\User;
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
    public function definition()
    {
        return [
            'uuid' => fake()->uuid(),
            'nis' => fake()->numerify('########'),
            'user_id' => User::factory(),
            'rayon_id' => Rayon::factory(),
            'rombel_id' => Rombel::factory(),
            'created_at' => now(),
        ];
    }
}
