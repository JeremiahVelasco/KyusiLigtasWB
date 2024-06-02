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
            'department' => fake()->randomElement(['Medical', 'Fire']),
            'category' => fake()->randomElement(['Emergency Report', 'Incident Report']),
            'station' => fake()->randomElement(['Masambong Station', 'Congress Fire Station', 'Eastwood Fire Station', 'Pinagkaisahan Fire Station', 'Novaliches Fire Station', 'Baesa Fire Station', 'Argonix Medical Corporation', 'Stoutcon Emergency Response Services', 'East Avenue Medical Center', 'Novaliches District Hospital', 'PNP General Hospital', 'Quezon City General Hospital', 'Quirino Memorial Medical Center', 'Veterans Memorial Medical Center', 'Diliman Doctors Hospital, Inc.', 'St. Luke’s Medical Center']),
            'message' => fake()->paragraph(2),
            'video' => fake()->word() . '.mp4',
            'recording' => fake()->word() . '.mp3',
            'status' => fake()->randomElement(['Pending', 'In Progress', 'Resolved', 'Cancelled']),
            'date' => fake()->date(),
            'time' => fake()->time(),
            'lat' => fake()->latitude(14.61, 14.76),
            'lng' => fake()->longitude(121.02, 121.14),
        ];
    }
}
