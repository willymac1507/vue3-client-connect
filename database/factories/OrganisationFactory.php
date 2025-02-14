<?php

namespace Database\Factories;

use App\Models\Organisation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

/**
 * @extends Factory<Organisation>
 */
class OrganisationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomUser = Http::get('https://randomuser.me/api/?nat=gb');
        $randomPostcode = Http::get('https://api.postcodes.io/random/postcodes');
        $data = $randomUser->json('results.0');
        $post = $randomPostcode->json('result');

        return [
            'name' => fake()->company(),
            'address1' => $data['location']['street']['number'] . ' ' . $data['location']['street']['name'],
            'town' => $data['location']['city'],
            'postcode' => $post['postcode'],
            'country' => $data['location']['country'],
            'email' => $data['email'],
            'telephone' => $data['phone'],
            'contact' => $data['name']['first'] . ' ' . $data['name']['last'],
            'lat' => $post['latitude'],
            'lng' => $post['longitude'],
        ];
    }
}
