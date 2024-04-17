<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function createUser(array $data): User
    {
        return User::create([
            'name' => 'Prof. '.$data['name'],
            'email' => $data['email'],
            'password' => bcrypt('123'),
            'user_type' => 'professor',
        ]);
    }

    public function deleteUser(User $user): bool
    {
        return $user->delete();
    }
}
