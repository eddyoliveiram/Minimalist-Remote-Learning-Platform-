<?php

namespace Database\Seeders;

use App\Models\Professor;
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

        Professor::factory(10)->create()->each(function ($professor) {
            $user = User::factory()->create([
                'user_type' => 'professor',
                'password' => '123'
            ]);
            $professor->update(['user_id' => $user->id]);
        });
//        User::factory(8)->create();
    }
}
