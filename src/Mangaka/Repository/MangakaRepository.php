<?php

namespace Mangaka\Repository;

use Common\Core\App;
use Common\Core\Database;
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
    $result = $this->db->query("SELECT * FROM $this->table")->fetchAll;
    return array_map(fn ($data) => new Mangaka($data), $result);
  }

  public function getMangakaById(int $id)
  {
    $result = $this->db->query("SELECT * FROM $this->table WHERE Id_mangaka = :id", ['id' => $id])->fetchOrFail();
    return $result ? new Mangaka($result) : null;
  }

  public function createMangaka(Mangaka $mangaka)
  {
    $query = "INSERT INTO mangakas(
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
    $query = "UPDATE mangakas
    SET img_mangaka = :img_mangaka,
        first_name = :first_name,
        last_name = :last_name,
        birthdate = :birthdate,
        texte = :texte,
        is_deleted = :is_deleted
    WHERE Id_mangaka = :Id_mangaka";

    $values = [
      'Id_mangaka' => $mangaka->Id_mangaka,
      'img_mangaka' => $mangaka->img_mangaka,
      'first_name' => $mangaka->first_name,
      'last_name' => $mangaka->last_name,
      'birthdate' => $mangaka->birthdate,
      'texte' => $mangaka->texte,
      'is_deleted' => $mangaka->is_deleted,
    ];

    try {
      $this->db->query($query, $values);
    } catch (\PDOException $e) {
      throw new \Exception("Erreur lors de la mise à jour de mangaka : " . $e->getMessage());
    }
  }

  public function deleteMangaka(int $id)
  {
    $this->db->query("DELETE FROM $this->table WHERE Id_mangaka = :id", ['id' => $id]);
  }
}
