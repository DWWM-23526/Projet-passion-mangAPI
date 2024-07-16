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

  public function getMangaById(string $idColumn, int $id)
  {
    $result = $this->db->query("SELECT * FROM $this->table WHERE {$idColumn} = :id", ['id' => $id])->fetchOrFail();
    return $result ? new Manga($result) : null;
  }

  public function createManga(Manga $manga)
  {
    $query = "INSERT INTO mangas(
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

    $values = Manga::toArray($manga);

    try {
      $this->db->query($query, $values);
    } catch (\PDOException $e) {
      throw new \Exception("Error on manga" . $e->getMessage());
    }
  }

  public function updateManga(Manga $manga)
  {
    $query = "UPDATE mangas
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

    $values = [
      'Id_manga' => $manga->Id_manga,
      'img_manga' => $manga->img_manga,
      'manga_name' => $manga->manga_name,
      'edition' => $manga->edition,
      'total_tome_number' => $manga->total_tome_number,
      'year_release' => $manga->year_release,
      'tome_number' => $manga->tome_number,
      'texte' => $manga->texte,
      'Id_mangaka' => $manga->Id_mangaka,
      'is_deleted' => $manga->is_deleted,
    ];

    try {
      $this->db->query($query, $values);
    } catch (\PDOException $e) {
      throw new \Exception('Erreur lors de la mise à jour du manga: ' . $e->getMessage());
    }
  }

  public function deleteManga(string $idColumn, int $id)
  {
    $this->db->query("DELETE FROM $this->table WHERE {$idColumn} = :id", ['id'=>$id]);
  }
  
}
