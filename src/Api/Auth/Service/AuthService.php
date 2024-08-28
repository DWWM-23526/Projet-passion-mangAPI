<?php

namespace Api\Auth\Service;

use Api\Users\Repository\RoleRepository;
use Core\App;
use Api\Users\Repository\UsersRepository;
use Core\Handler\JwtHandler;

class AuthService
{
    private UsersRepository $usersRepository;
    private RoleRepository $roleRepository;

    public function __construct()
    {
        $this->usersRepository = App::injectRepository()->getContainer(UsersRepository::class);
        $this->roleRepository = App::injectRepository()->getContainer(RoleRepository::class);
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
        $roleWeight = $this->getRoleWeight($user->id_role);
        $token = JwtHandler::generateToken($user, $roleWeight);
        unset($user->is_deleted, $user->password);

        return (object)['userData' => $user, 'token' => $token];
    }

    private function getRoleWeight(int $id)
    {
        try {
            $role = $this->roleRepository->getItemById($id);
            $roleWeight = $role->role_weight;
            return $roleWeight;
        } catch (\Throwable $th) {
            throw new \Exception("Role don't exist" . $th);
        }
    }

    public function validateToken(array $headers)
    {
        try {

            $headers = array_change_key_case($headers, CASE_LOWER);

            $token = str_replace('Bearer ', '', $headers['authorization']);

            $decodedToken = JwtHandler::validateToken($token);

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

    public function idRoleToken(array $headers)
    {

        $headers = array_change_key_case($headers, CASE_LOWER);

        try {

            $token = str_replace('Bearer ', '', $headers['authorization']);

            $decodedToken = JwtHandler::validateToken($token);

            if (!$decodedToken || !isset($decodedToken['Id_user'])) {
                return null;
            }

            $userById = $this->usersRepository->getItemById($decodedToken['Id_user']);

            if (!$userById) {
                return null;
            }

            unset($userById->is_deleted, $userById->password, $userById->email, $userById->id, $userById->name);

            return $userById;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
