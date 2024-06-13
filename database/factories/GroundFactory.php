<?php

namespace Database\Factories;

use App\Models\Ground;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ground>
 */
class GroundFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'direction' => $this->faker->address,
            'grant_number' => $this->faker->word,
            'square_meter' => $this->faker->randomFloat(2, 100, 10500),
            'type' => "ORNATO"
        ];
    }
}
