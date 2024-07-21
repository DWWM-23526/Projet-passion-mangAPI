<?php

namespace Api\Mangaka\Repository;

use Api\Manga\Model\Manga;
use Api\Mangaka\Model\Mangaka;
use Core\ORM\Repository;

class MangakaRepository extends Repository
{
  protected $table = 'mangakas';
  protected $modelClass = Mangaka::class;
  protected $primaryKey = 'Id_mangaka';

  public function getAllMangakas()
  {
    return $this->getAll();
  }

  public function getMangakaById(int $mangakaId)
  {
    return $this->getBy($mangakaId, 'Id_mangaka');
  }

  public function getAllRelatedManga($id)
  {
    return $this->hasMany(Manga::class, 'mangas', $this->primaryKey, $id);
  }

  public function createMangaka($data)
  {
    return $this->create($data);
  }

  public function updateMangaka($data, $id)
  {
    return $this->update($data, $id);
  }

  public function deleteMangaka($id)
  {
    return $this->delete($id, 'Id_mangaka');
  }
}
