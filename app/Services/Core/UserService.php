<?php

namespace App\Services\Core;

use App\Models\User;
use App\Services\Core\User\CreateUserParams;


interface UserService
{
    public function createUser(CreateUserParams $params): User;

    public function getUserById(int $id): User;

    public function getUserEmail(string $email);


}
