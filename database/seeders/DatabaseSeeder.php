<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Remove this if you don't need Laravel default users table seeding
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UsersinfoSeeder::class,  // usersinfo first
            CategorySeeder::class,   // categories next
            ProductSeeder::class,    // products last
        ]);
    }
}
