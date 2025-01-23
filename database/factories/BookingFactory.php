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
        $endDate = $startDate->add(DateInterval::createFromDateString('1 hour'));
        return [
            'start' => $startDate,
            'end' => $endDate,
            'description' => $this->faker->sentence()
        ];
    }
}
