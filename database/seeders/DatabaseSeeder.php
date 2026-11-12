<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => env('SEED_ADMIN_NAME', 'Admin'),
            'email' => env('SEED_ADMIN_EMAIL', 'admin@example.com'),
            'password' => Hash::make(env('SEED_ADMIN_PASSWORD', 'password')),
        ]);
    }
}
