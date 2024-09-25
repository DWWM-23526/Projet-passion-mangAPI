<?php

namespace Auth\Services;

use Auth\Repositories\RoleRepository;
use Auth\Repositories\UsersRepository;
use Core\App;
use Auth\Handlers\JwtHandler;
use Auth\Services\MailerService;
use Exception;

class AuthService
{
    private UsersRepository $usersRepository;
    private RoleRepository $roleRepository;
    private MailerService $mailerService;

    public function __construct()
    {
        $this->usersRepository = App::injectRepository()->getContainer(UsersRepository::class);
        $this->roleRepository = App::injectRepository()->getContainer(RoleRepository::class);
        $this->mailerService = App::injectService()->getContainer(MailerService::class);
    }

    public function authentication(string $email, string $password)
    {

        try {
            $user = $this->usersRepository->getUserByEmail($email);
        } catch (Exception $e) {
            return $e;
        }
        if (!$user || !password_verify($password, $user->password)) {
            throw new Exception("password or email incorrect", 400);
        }
        $roleWeight = $this->getRoleWeight($user->id_role);
        $token = JwtHandler::generateToken($user, $roleWeight);
        unset($user->is_deleted, $user->password);

        return (object) ['userData' => $user, 'token' => $token];
    }

    private function getRoleWeight(int $id)
    {
        try {
            $role = $this->roleRepository->getItemById($id);
            $roleWeight = $role->role_weight;
            return $roleWeight;
        } catch (Exception $e) {
            throw new Exception("Role don't exist" . $e);
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
        } catch (Exception $e) {
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
        } catch (Exception $e) {
            return $e;
        }
    }

    public function requestPasswordReset(string $email)
    {
        try {
            $user = $this->usersRepository->getUserByEmail($email);
            if (!$user) {
                throw new Exception("User not found", 404);
            }
            $resetToken = JwtHandler::generatePasswordResetToken(['Id_user' => $user->Id_user]);
            $mailSendedToUser = $this->mailerService->sendPasswordResetEmail($user->email, $resetToken);

            return $mailSendedToUser;
        } catch (Exception $e) {
            throw new Exception("Failed to send password reset email: " . $e->getMessage());
        }
    }

    public function updatePassword(string $token, string $newPassword)
    {
        try {
            $decodedToken = JwtHandler::validateToken($token);
            if (!$decodedToken || !isset($decodedToken['Id_user'])) {
                throw new Exception("Invalid or expired token", 400);
            }

            $user = $this->usersRepository->getItemById($decodedToken['Id_user']);
            if (!$user) {
                throw new Exception("User not found", 404);
            }

            $hashedPassword = password_hash($newPassword, PASSWORD_ARGON2ID);

            $newUserWithUpdatedPassword = $this->usersRepository->updatePasswordUser($user->Id_user, $hashedPassword);

            return $newUserWithUpdatedPassword;
        } catch (Exception $e) {
            throw new Exception("Failed to update password: " . $e->getMessage(), 500);
        }
    }
}
