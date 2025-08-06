<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder; // ✅ Add this line
use App\Models\User;
use Database\Seeders\RoomSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(RoomSeeder::class); // ✅ Call RoomSeeder
    }
}
