<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject' => $this->faker->sentence(5),
            'body' => $this->faker->paragraph(),
            'sender_id' => $this->faker->numberBetween(1, 81),
            'recipient_id' => 1,
            'isRead' => $this->faker->randomElement([0, 1]),
            'created_at' => $this->faker->dateTimeThisYear('now')
        ];
    }
}
