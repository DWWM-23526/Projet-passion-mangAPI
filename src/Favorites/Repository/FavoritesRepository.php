<?php

namespace Favorites\Repository;

use Common\Core\App;
use Common\Core\Database;



class FavoritesRepository
{
    private string $table = 'favoris';
    private Database $db;

    public function __construct()
    {
        $this->db = App::inject()->getContainer(Database::class);
    }

    // CRUD

    public function getAllFavorites(): array
    {
        return $this->db->query("SELECT * FROM $this->table")->fetchAllOrFail();
    }

    public function getAllUserFavoritesByUserId(int $id): ?array
    {
        return $this->db->query("SELECT * FROM $this->table WHERE Id_user = :id", [':id' => $id])->fetchAllOrFail();
    }

    public function createFavorites(array $favorites): void
    {
        $query = "INSERT INTO $this->table (Id_manga, Id_user) VALUES (:Id_manga, :Id_user)";

        $values = [
            ':Id_manga' => $favorites['Id_manga'],
            ':Id_user' => $favorites['Id_user']
        ];

        try {
            $this->db->query($query, $values);
        } catch (\PDOException $e) {
            throw new \Exception("Error creating favorites: " . $e->getMessage());
        }
    }

    public function deleteFavorites(array $favorites): void
    {
        $query = "DELETE FROM $this->table WHERE Id_manga = :Id_manga AND Id_user = :Id_user";

        $values = [
            ':Id_manga' => $favorites['Id_manga'],
            ':Id_user' => $favorites['Id_user'],
        ];

        try {
            $this->db->query($query, $values);
        } catch (\PDOException $e) {
            throw new \Exception("Error deleting favorites: " . $e->getMessage());
        }
    }
}
