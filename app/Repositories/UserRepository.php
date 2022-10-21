<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserRepository
{
    public function getUserById(int $userId)
    {

        return User::find($userId);
    }

    public function getByEmail(string $email)
    {
        return User::where(['email' => $email])->first();
    }

    public function createUser(string $name, string $email, string $password, string $googleId, string $facebookId): User
    {
        $user =  User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'google_id' => $googleId,
            'facebook_id' => $facebookId
        ]);
        Log::info('Created User with ', ['name' => $user->name, 'email' => $user->email,]);

        return $user;

    }

}
