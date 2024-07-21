<?php

namespace Api\Manga\Repository;

use Api\Manga\Model\Manga;
use Api\Mangaka\Model\Mangaka;
use Core\ORM\Repository;
use Tags\Model\Tags;

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
    return $this->getBy($mangaId, $this->primaryKey);
  }

  public function getRelatedMangaka(int $mangaId)
  {
    $manga = $this->getBy($mangaId, $this->primaryKey);

    if (!$manga) {
      throw new \Exception("Manga not found");
    }

    return $this->belongTo(Mangaka::class, 'mangakas', 'Id_mangaka', $manga->Id_mangaka);
  }

  public function getAllMangaRelatedTags($mangaId)
  {
    return $this->belongToMany(Tags::class, 'tags', 'tags_manga', 'Id_tag', $mangaId);
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
