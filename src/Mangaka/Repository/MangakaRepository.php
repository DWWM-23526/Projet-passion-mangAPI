<?php

namespace Mangaka\Repository;

use Core\App;
use Core\Database;
use Mangaka\Model\Mangaka;

class MangakaRepository
{
  private string $table = 'mangakas';
  private mixed $db;

  public function __construct()
  {
    $this->db = App::inject()->getContainer(Database::class);
  }

  public function getAllMangakas()
  {
    $result = $this->db->query("SELECT * FROM $this->table")->fetchAllOrFail();
    return array_map(fn ($data) => new Mangaka($data), $result);
  }

  public function getMangakaById(int $id)
  {
    $result = $this->db->query("SELECT * FROM $this->table WHERE Id_mangaka = :id", ['id' => $id])->fetchOrFail();
    return $result ? new Mangaka($result) : null;
  }

  public function createMangaka(Mangaka $mangaka)
  {
    $query = "INSERT INTO $this->table(
    Id_mangaka,
    img_mangaka,
    first_name,
    last_name,
    birthdate,
    texte,
    is_deleted)
    VALUES (
    :Id_mangaka,
    :img_mangaka,
    :first_name,
    :last_name,
    :birthdate,
    :texte,
    :is_deleted)";

    $values = $mangaka->toArray();

    try {
      $this->db->query($query, $values);
    } catch (\PDOException $e) {
      throw new \Exception("Error on Mangaka" . $e->getMessage());
    }
  }

  public function updateMangaka(Mangaka $mangaka)
  {
    $query = "UPDATE $this->table
    SET img_mangaka = :img_mangaka,
        first_name = :first_name,
        last_name = :last_name,
        birthdate = :birthdate,
        texte = :texte,
        is_deleted = :is_deleted
    WHERE Id_mangaka = :Id_mangaka";

    $values = $mangaka->toArray();

    try {
      $this->db->query($query, $values);
    } catch (\PDOException $e) {
      throw new \Exception("Erreur lors de la mise à jour de mangaka : " . $e->getMessage());
    }
  }

  public function deleteMangaka(int $id)
  {
    try {
      $this->db->query("DELETE FROM $this->table WHERE Id_mangaka = :id", ['id' => $id]);
    } catch (\PDOException $e) {
      throw new \Exception("Erreur lord du delete de mangaka :" / $e->getMessage());
    }
  }
}
