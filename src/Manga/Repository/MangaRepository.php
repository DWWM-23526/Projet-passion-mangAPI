<?php

namespace Manga\Repository;

use Common\Core\App;
use Common\Core\Database;
use Manga\Model\Manga;

class MangaRepository
{
  private string $table = 'mangas';
  private mixed $db;

  public function __construct()
  {
    $this->db = App::inject()->getContainer(Database::class);
  }

  // CRUD

  public function getAllMangas()
  {
    $result = $this->db->query("SELECT * FROM $this->table")->fetchAll();
    return array_map(fn ($data) => new Manga($data), $result);
  }

  public function getMangaById(int $id)
  {
    $result = $this->db->query("SELECT * FROM $this->table WHERE Id_manga = :id", ['id' => $id])->fetchOrFail();
    return $result ? new Manga($result) : null;
  }

  public function createManga(Manga $manga)
  {
    $query = "INSERT INTO $this->table(
      Id_manga,
      img_manga,
      manga_name,
      edition,
      total_tome_number,
      year_release,
      tome_number,
      texte,
      Id_mangaka,
      is_deleted)
  VALUES (
      :Id_manga,
      :img_manga,
      :manga_name,
      :edition,
      :total_tome_number,
      :year_release,
      :tome_number,
      :texte,
      :Id_mangaka,
      :id_deleted)";

    $values = $manga->toArray();

    try {
      $this->db->query($query, $values);
    } catch (\PDOException $e) {
      throw new \Exception("Error on Manga" . $e->getMessage());
    }
  }

  public function updateManga(Manga $manga)
  {
    $query = "UPDATE $this->table
              SET img_manga = :img_manga,
                  manga_name = :manga_name,
                  edition = :edition,
                  total_tome_number = :total_tome_number,
                  year_release = :year_release,
                  tome_number = :tome_number,
                  texte = :texte,
                  Id_mangaka = :Id_mangaka,
                  id_deleted = :id_deleted
              WHERE Id_manga = :Id_manga";

    $values = $manga->toArray();

    try {
      $this->db->query($query, $values);
    } catch (\PDOException $e) {
      throw new \Exception('Erreur lors de la mise à jour du manga: ' . $e->getMessage());
    }
  }

  public function deleteManga(int $id)
  {
    try {
      $this->db->query("DELETE FROM $this->table WHERE Id_Manga = :id", ['id' => $id]);
    } catch (\PDOException $e) {
      throw new \Exception("Erreur lors du delete du manga: " . $e->getMessage());
    }
  }
}
