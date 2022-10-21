<?php

namespace App\Services\Impl;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Core\User\CreateUserParams;

class UserServiceImpl implements \App\Services\Core\UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserById(int $id): User
    {
        return $this->userRepository->getUserById($id);
    }

    public function createUser(CreateUserParams $params): User
    {
        return $this->userRepository->createUser($params->getName(), $params->getEmail(), $params->getPassword(), $params->getGoogleId(), $params->getFacebookId());
    }

    public function getUserEmail(string $email)
    {
        return $this->userRepository->getByEmail($email);
    }
}
