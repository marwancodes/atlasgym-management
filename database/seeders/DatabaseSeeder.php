<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // seed the root admin
        User::create([
            "name" => "Admin",
            "email" => "admin@admin.com",
            "password" => Hash::make("Abdc1234"),
            "role" => "admin",
            "email_verified_at" => now()
        ]);
    }
}
