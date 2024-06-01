<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'citizen_id' => fake()->numberBetween(1234, 9999),
            // 'location' => fake()->address(),
            'department' => fake()->randomElement(['Medical', 'Fire']),
            'category' => fake()->randomElement(['Emergency Report', 'Incident Report']),
            'station' => fake()->city(),
            'message' => fake()->paragraph(2),
            'video' => fake()->word() . '.mp4',
            'status' => fake()->randomElement(['Pending', 'In Progress', 'Resolved', 'Cancelled']),
            'lat' => fake()->latitude(),
            'lng' => fake()->longitude(),
        ];
    }
}
