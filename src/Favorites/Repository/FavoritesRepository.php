<?php

namespace Favorites\Repository;

use Core\App;
use Core\Database;



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

    public function createFavorites(array $data): void
    {
        $query = "INSERT INTO $this->table (Id_manga, Id_user) VALUES (:Id_manga, :Id_user)";

        $values = [
            ':Id_manga' => $data['Id_manga'],
            ':Id_user' => $data['Id_user']
        ];

        try {
            $this->db->query($query, $values);
        } catch (\PDOException $e) {
            throw new \Exception("Error creating favorites: " . $e->getMessage());
        }
    }

    public function deleteFavorites(int $userId, int $mangaId): void
    {
        $query = "DELETE FROM $this->table WHERE Id_manga = :Id_manga AND Id_user = :Id_user";

        $values = [
            ':Id_manga' => $mangaId,
            ':Id_user' => $userId
        ];

        try {
            $this->db->query($query, $values);
        } catch (\PDOException $e) {
            throw new \Exception("Error deleting favorites: " . $e->getMessage());
        }
    }
}
