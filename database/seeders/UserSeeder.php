<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@blue.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);

        // Random 10 user
        User::factory()->count(10)->create();
    }
}
