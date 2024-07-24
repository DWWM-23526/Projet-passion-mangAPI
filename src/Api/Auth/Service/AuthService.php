<?php

namespace Api\Auth\Service;

use Core\App;
use Api\Users\Repository\UsersRepository;

class AuthService
{
    private UsersRepository $usersRepository;

    public function __construct()
    {
        $this->usersRepository = App::injectRepository()->getContainer(UsersRepository::class);
    }

    public function authentication(string $email, string $password)
    {
        $errors = [];

        $user = $this->usersRepository->getUserByEmail($email);

        if (!$user || $password != $user->password) {
            $errors["passwordError"] = "password or email incorrect";
        }

        if (empty($errors)) {
            return $user;
        } else {
            return $errors;
        }
    }
}
