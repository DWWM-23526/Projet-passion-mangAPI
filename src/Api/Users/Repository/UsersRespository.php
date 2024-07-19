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

}