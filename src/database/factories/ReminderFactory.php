<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reminder>
 */
class ReminderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->word(),
            'description' => fake()->sentence(),
            'remind_at' => 1703320185, // December 23, 2023 8:29:45 AM https://www.epochconverter.com/
            'event_at' => now()->timestamp,
            'user_id' => rand(1, 2)
        ];
    }
}
