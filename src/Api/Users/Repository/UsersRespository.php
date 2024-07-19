<?php

namespace Api\Users\Repository;


use Core\ORM\Repository;

class UsersRespository extends Repository
{
    protected $table = 'users';

    public function getAllUsers()
    {
        return $this->getAll();
    }

    public function getUserById(int $userId)
    {
        return $this->getBy($userId, 'Id_user');
    }

}