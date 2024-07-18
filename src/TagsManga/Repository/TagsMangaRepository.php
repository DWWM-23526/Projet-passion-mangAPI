<?php

namespace TagsManga\Repository;

use Common\Core\App;
use Common\Core\Database;



class TagsMangaRepository
{
    private string $table = 'tags_manga';
    private Database $db;

    public function __construct()
    {
        $this->db = App::inject()->getContainer(Database::class);
    }

    // CRUD

    public function getAll(): array
    {
        return $this->db->query("SELECT * FROM $this->table")->fetchAllOrFail();
    }

    public function getAllMangaTags(int $mangaId): ?array
    {
        return $this->db->query("SELECT * FROM $this->table WHERE Id_manga = :id", [':id' => $mangaId])->fetchAllOrFail();
    }

    public function getAllTagMangas(int $tagId): ?array
    {
        return $this->db->query("SELECT * FROM $this->table WHERE Id_tag = :id", [':id' => $tagId])->fetchAllOrFail();
    }

    public function createTagManga(array $tagsManga): void
    {
        $query = "INSERT INTO $this->table (Id_manga, Id_tag) VALUES (:Id_manga, :Id_tag)";

        $values = [
            ':Id_manga' => $tagsManga['Id_manga'],
            ':Id_tag' => $tagsManga['Id_tag']
        ];

        try {
            $this->db->query($query, $values);
        } catch (\PDOException $e) {
            throw new \Exception("Error creating favorites: " . $e->getMessage());
        }
    }

    public function deleteTagManga(int $tagId, int $mangaId): void
    {
        $query = "DELETE FROM $this->table WHERE Id_manga = :Id_manga AND Id_tag = :Id_tag";

        $values = [
            ':Id_manga' => $mangaId,
            ':Id_tag' => $tagId,
        ];

        try {
            $this->db->query($query, $values);
        } catch (\PDOException $e) {
            throw new \Exception("Error deleting favorites: " . $e->getMessage());
        }
    }
}
