<?php

namespace Api\Users\Service;

use Core\App;
use Api\Users\Repository\UsersRepository;

class UsersService{
    private UsersRepository $usersRepository;

    public function __construct(){
        $this->usersRepository = App::injectRepository()->getContainer(UsersRepository::class);
    }

    public function getAllUsers(){
        return $this->usersRepository->getAllUsers();
    }

    public function getUserById(int $id)
    {
        return $this->usersRepository->getUserById($id);
    }
    
    public function createUser($data)
    {
        return $this->usersRepository->createUser($data);
    }

    public function updateUser($data, $id)
    {
        return $this->usersRepository->updateUser($data, $id);
    }

    
    public function deleteUser($id)
    {
        return $this->usersRepository->deleteUser($id);
    }
    

   
}