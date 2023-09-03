<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User
        User::create([
            'name' => 'Test User',
            'role_id' => 1,
            'email' => 'user@example.com',
            'password' => Hash::make(123),
        ]);
        // Editor
        User::create([
            'name' => 'Test Editor',
            'role_id' => 2,
            'email' => 'editor@example.com',
            'password' => Hash::make(123),
        ]);
        // Admin
        User::create([
            'name' => 'Test Admin',
            'role_id' => 3,
            'email' => 'admin@example.com',
            'password' => Hash::make(123),
        ]);
    }
}