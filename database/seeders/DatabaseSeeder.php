<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Calendar;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Organisation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users::factory(10)->create();

        User::factory()->create([
            'firstname' => 'Will',
            'surname' => 'McCloy',
            'email' => 'will@email.com',
            'password' => 'password',
            'organisation_id' => 99
        ]);

        Organisation::factory(10)->has(User::factory(5)->has(Calendar::factory()))->create();

        Organisation::factory()->create([
            'id' => 99,
            'name' => 'camelCase Ltd',
            'address1' => '4 Sunny Hill',
            'address2' => null,
            'town' => 'Norwich',
            'postcode' => 'NR1 2ES',
            'country' => 'United Kingdom',
            'email' => 'info@camelcase.uk',
            'telephone' => '07808 550651',
            'contactFirstName' => 'Will',
            'contactLastName' => 'McCloy'
        ]);

        User::factory(30)->has(Booking::factory(5)->has(Message::factory(5)))->create([
            'organisation_id' => null
        ]);

        Role::factory()->create([
            'id' => 1,
            'role' => 'superUser'
        ]);

        Role::factory()->create([
            'id' => 2,
            'role' => 'admin'
        ]);

        Role::factory()->create([
            'id' => 3,
            'role' => 'student'
        ]);

        Role::factory()->create([
            'id' => 4,
            'role' => 'client'
        ]);

        Conversation::factory(10)->has(Message::factory(10))->create();
    }
}
