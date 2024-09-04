<?php

namespace Api\Repositories;

use Api\Models\Manga;
use Api\Models\Mangaka;
use Core\repositories\_BaseApiRepository;

class MangakaRepository extends _BaseApiRepository
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
