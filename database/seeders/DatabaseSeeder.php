<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'is_admin' => 1,
        ]);

        User::factory()->create([
            'name' => 'user',
            'email' => 'user@user.com',
            'phone' => '01131389418',
            'password' => Hash::make('user'),
            'is_admin' => 0,
        ]);
    }
}
