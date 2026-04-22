<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@tourfreak.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin@123'),
                'role' => 'admin',
                'email_verified_at' => now(),
                'email_notifications' => true,
                'booking_notifications' => true,
                'promotional_notifications' => true,
            ]
        );
    }
}
