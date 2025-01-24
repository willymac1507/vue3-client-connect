<?php

namespace Database\Factories;

use App\Models\Booking;
use DateInterval;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeThisYear('+2 months');
        $endDate = clone $startDate;
        $endDate->add(new DateInterval('PT1H'));
        return [
            'start' => $startDate,
            'end' => $endDate,
            'student_id' => $this->faker->randomElement([2, 3, 4, 5, 6]),
            'description' => $this->faker->sentence()
        ];
    }
}
