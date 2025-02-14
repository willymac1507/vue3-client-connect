<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
//        $pictures = Storage::json('randomuser.me.json');
//        $profileThumb = $pictures["results"][rand(0, 79)]["picture"]["thumbnail"];
        $randomUser = Http::get('https://randomuser.me/api/?nat=gb');
        $data = $randomUser->json('results.0');

        return [
            'firstname' => $data['name']['first'],
            'surname' => $data['name']['last'],
            'email' => $data['email'],
            'email_verified_at' => now(),
            'profile_picture_path' => $data['picture']['medium'],
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function configure(): UserFactory
    {
        return $this->afterCreating(function (User $user) {
            $user->roles()->attach(4);
            if ($user->organisation_id) {
                $user->roles()->attach(3);
            }
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

}
