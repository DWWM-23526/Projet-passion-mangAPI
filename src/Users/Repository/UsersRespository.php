<?php

namespace Users\Repository;

use Core\App;
use Core\Database;
use Users\Model\Users;

class UsersRespository
{
    private $db;

    public function __construct(){
        $this->db = App::inject()->getContainer(Database::class);
    }

    public function getAllUsers(){
        $results = $this->db->query("SELECT * FROM  users")->fetchAllOrFail();
        return array_map(fn ($data) => new Users($data),$results);
    }

    public function getUsersById(int $id)
    {
        $result = $this->db->query("SELECT * FROM users WHERE Id_tag = :id", ['id' => $id])->fetchOrFail();
        return $result ? new Users($result) : null;
    }

    public function createUser(Users $user){
        $sql = "INSERT INTO users (Id_user, name, email, password, is_deleted)
        VALUES (:Id_user, :name, :email, :password, :is_deleted)";

        $values = $user->toArray();

        try {
            $this->db->query($sql, $values);
        } catch(\PDOException $e){
            throw new \Exception("Error on Tag creation" . $e->getMessage());
        }
    }

    public function updateUser(Users $user){
        $sql = "UPDATE users
        SET password = :password, email = :email, name = :name, is_deleted = :is_deleted
        WHERE Id_user = :Id_user";

        $values = $user->toArray();

        try {
            $this->db->query($sql, $values);
        } catch (\PDOException $e) {
            throw new \Exception("Error on User update" . $e->getMessage());
        }
    }

    public function deleteUser(int $id){
        $sql = "DELETE FROM users WHERE Id_user = :id";
        try {
            $this->db->query($sql, ['id' => $id]);
        } catch (\PDOException $e) {
            throw new \Exception("Error on User delete" . $e->getMessage());
        }
    }
}