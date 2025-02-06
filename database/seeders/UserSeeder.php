<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'User 1',
            'email' => 'user1@example.com',
        ]);

        User::factory()->create([
            'name' => 'User 2',
            'email' => 'user2@example.com',
        ]);

    }
}
