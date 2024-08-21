<?php

namespace Api\Mangaka\Repository;

use Api\Manga\Model\Manga;
use Api\Mangaka\Model\Mangaka;
use Core\Base\BaseApiRepository;


class MangakaRepository extends BaseApiRepository
{
  protected $table = 'mangakas';
  protected $modelClass = Mangaka::class;
  protected $primaryKey = 'Id_mangaka';

  public function searchMangakaByName(array $searchTerm)
  {
    return $this->search($searchTerm,['first_name', 'last_name']);
  }

  public function getAllRelatedManga($id)
  {
    return $this->hasMany(Manga::class, 'mangas', $this->primaryKey, $id);
  }
}
