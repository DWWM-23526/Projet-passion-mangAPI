<?php

namespace Api\Auth\Service;

use Core\App;
use Api\Users\Repository\UsersRepository;
use core\HTTPResponse;
use Services\JwtService;

class AuthService
{
    private UsersRepository $usersRepository;
    private JwtService $jwtService;

    public function __construct()
    {
        $this->usersRepository = App::injectRepository()->getContainer(UsersRepository::class);
        $this->jwtService = App::injectService()->getContainer(JwtService::class);
    }

    public function authentication(string $email, string $password)
    {
        $errors = [];

        $user = $this->usersRepository->getUserByEmail($email);

        if (!$user || $password != $user->password) {
            $errors["passwordError"] = "password or email incorrect";
        }

        $token = $this->jwtService->generateToken($user);

        unset($user->is_deleted, $user->password);

        if (empty($errors)) {
            return $object = (object)['userData' => $user, 'token' => $token];
        } else {
            return $errors;
        }
    }

    public function validateToken(array $headers)
    {
        try {

            $token = str_replace('Bearer ', '', $headers['Authorization']);

            $decodedToken = $this->jwtService->validateToken($token);

            if (!$decodedToken || !isset($decodedToken['Id_user'])) {
                return null;
            }

            $userById = $this->usersRepository->getUserById($decodedToken['Id_user']);

            if (!$userById) {
                return null;
            }

            unset($userById->is_deleted, $userById->password);

            return $userById;
        } catch (\InvalidArgumentException $e) {

            return null;
        } catch (\Exception $e) {

            return null;
        }
    }
}
