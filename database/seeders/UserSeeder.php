<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'password' => '123',
            'email' => 'admin@gmail.com',
            'user_type' => 'admin'
        ]);

        User::factory()->create([
            'name' => 'Professor',
            'password' => '123',
            'email' => 'professor@gmail.com',
            'user_type' => 'professor'
        ]);

        User::factory(8)->create();
    }
}
