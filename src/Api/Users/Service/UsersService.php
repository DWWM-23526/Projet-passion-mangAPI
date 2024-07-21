<?php

namespace Api\Users\Service;

use Core\App;
use Api\Users\Repository\UsersRespository;

class UsersService{
    private UsersRespository $usersRespository;

    public function __construct(){
        $this->usersRespository = App::injectRepository()->getContainer(UsersRespository::class);
    }

    public function getAllUsers(){
        return $this->usersRespository->getAllUsers();
    }

    public function getUserById(int $id)
    {
        return $this->usersRespository->getUserById($id);
    }
    
    public function createUser($data)
    {
        return $this->usersRespository->createUser($data);
    }

    public function updateUser($data, $id)
    {
        return $this->usersRespository->updateUser($data, $id);
    }

    
    public function deleteUser($id)
    {
        return $this->usersRespository->deleteUser($id);
    }
    

   
}