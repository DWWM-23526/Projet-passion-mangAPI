<?php

namespace Api\Users\Repository;

use Api\Users\Model\Users;
use Core\ORM\Repository;

class UsersRepository extends Repository
{
    protected $table = 'users';
    protected $modelClass = Users::class;
    protected $primaryKey = 'Id_user';

    public function getAllUsers()
    {
        return $this->getAll($this->table);
    }

    public function getUserById(int $userId)
    {
        return $this->getBy($userId, 'Id_user');
    }

    

    public function createUser($data)
    {
        return $this->create($data);
    }

    public function updateUser($data, $id)
    {
        return $this->update($data, $id);
    }

    public function deleteUser($id)
    {
        return $this->delete($id, 'Id_user');
    }

}