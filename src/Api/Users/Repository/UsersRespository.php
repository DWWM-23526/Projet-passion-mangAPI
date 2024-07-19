<?php

namespace Api\Users\Repository;

use Api\Users\Model\Users;
use Core\ORM\Repository;

class UsersRespository extends Repository
{
    protected $table = 'users';
    protected $modelClass = Users::class;

    public function getAllUsers()
    {
        return $this->getAll();
    }

    public function getUserById(int $userId)
    {
        return $this->getBy($userId, 'Id_user');
    }

    public function createUser($data)
    {
        $this->create($data);
    }

}