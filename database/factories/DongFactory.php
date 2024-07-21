<?php

namespace Database\Factories;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dong>
 */
class DongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Define an array to map thu_id to corresponding years
        $thuIdToYear = [
            1 => 2021,
            2 => 2022,
            3 => 2023,
            4 => 2024,
            // Add more mappings as needed
        ];

        // Generate a random year based on thu_id
        $thuId = $this->faker->numberBetween(1, 4); // Assuming thu_id ranges from 1 to 4
        $randomYear = $thuIdToYear[$thuId];

        // Generate a random date within the chosen year
        $startDate = Carbon::create($randomYear, 1, 1); // January 1st of the chosen year
        $endDate = Carbon::create($randomYear, 12, 31); // December 31st of the chosen year

        $randomDate = $this->faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d');

        return [
            'thu_id' => $thuId,
            'member_name' => $this->faker->name,
            'amount' => $this->faker->numberBetween(500000, 2000000),
            'payment_date' => $randomDate,
            'note' => $this->faker->sentence,
        ];
    
    }
}
