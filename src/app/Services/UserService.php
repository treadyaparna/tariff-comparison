<?php

namespace App\Services;


use App\Repositories\UserRepository;

class UserService
{
    public function __construct(private UserRepository $userRepo) {}

    public function addUser($name, $email, $password, $roleId): bool
    {
        return $this->userRepo->addUser($name, $email, $password, $roleId);
    }
}
