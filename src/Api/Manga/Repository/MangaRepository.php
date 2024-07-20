<?php

namespace Api\Manga\Repository;

use Api\Manga\Model\Manga;
use Core\ORM\Repository;

class MangaRepository extends Repository
{
  protected $table = 'mangas';
  protected $modelClass = Manga::class;
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
