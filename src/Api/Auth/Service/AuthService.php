<?php

namespace Api\Auth\Service;

use Core\App;
use Api\Users\Repository\UsersRepository;
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

        try {
            $user = $this->usersRepository->getUserByEmail($email);
        } catch (\Exception $e) {
            return $e;
        }
        if (!$user || !password_verify($password, $user->password)) {
            throw new \Exception("password or email incorrect", 400);
        }

        $token = $this->jwtService->generateToken($user);
        unset($user->is_deleted, $user->password, $user->id_role);

        return (object)['userData' => $user, 'token' => $token];
    }

    public function validateToken(array $headers)
    {
        try {

            $token = str_replace('Bearer ', '', $headers['Authorization']);

            $decodedToken = $this->jwtService->validateToken($token);

            if (!$decodedToken || !isset($decodedToken['Id_user'])) {
                return null;
            }

            $userById = $this->usersRepository->getItemById($decodedToken['Id_user']);

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
