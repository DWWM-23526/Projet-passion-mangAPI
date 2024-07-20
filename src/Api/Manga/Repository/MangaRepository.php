<?php

namespace Api\Manga\Repository;

use Api\Users\Model\Users;
use Core\App;
use Core\Database;
use Api\Manga\Model\Manga;
use Core\ORM\Repository;

class MangaRepository extends Repository
{
  private string $table = 'mangas';
  protected $modelClass = Users::class;
  protected $primaryKey = 'Id_manga';

  // CRUD

  public function getAllMangas()
  {
    return $this->getAll();
  }

  public function getMangaById(int $mangaId)
  {
    return $this->getBy($mangaId, 'Id_manga');
  }
  public function createManga($data)
  {
    return $this->create($data);
  }

  public function updateManga($data, $id)
  {
    return $this->update($data, $id);
  }

  public function deleteManga($id)
  {
    return $this->delete($id, 'Id_manga');
  }
}
