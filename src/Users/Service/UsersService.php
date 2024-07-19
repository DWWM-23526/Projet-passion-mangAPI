<?php

namespace Users\Service;

use Core\App;
use Users\Model\Users;
use Users\Repository\UsersRespository;

class UsersService{
    private UsersRespository $usersRespository;

    public function __construct(){
        $this->usersRespository = App::injectRepository()->getContainer(UsersRespository::class);
    }

    public function getAllUsers(){
        return $this->usersRespository->getAllUsers();
    }

    public function getUserById(int $id){
        return $this->usersRespository->getUsersById($id);
    }

    public function createUser(mixed $dataUsers){
        $user = new Users($dataUsers);
        return $this->usersRespository->createUser($user);
    }

    public function updateUsers(mixed $dataUsers){
        $user = new Users($dataUsers);
        return $this->usersRespository->updateUser($user);
    }

    public function deleteUser(int $id){
        return $this->usersRespository->deleteUser($id);
    }
}