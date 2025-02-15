<?php

namespace Api\Repositories;

use Api\Models\Manga;
use Api\Models\Mangaka;
use Api\Models\Tags;
use Core\repositories\_BaseApiRepository;

class MangaRepository extends _BaseApiRepository
{
  protected $table = 'mangas';
  protected $modelClass = Manga::class;
  protected $primaryKey = 'Id_manga';

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

  public function searchMangaByName(string $searchTerm)
  {
    return $this->search([$searchTerm], ['manga_name']);
  }

  public function checkIfIsUserFavorite(array $values, array $column)
  {
    return $this->checkIfExists('favoris', $values, $column);
  }

  public function addTagToManga(int $mangaId, int $tagId)
  {
    return $this->attach('tags_manga', $this->primaryKey, 'Id_tag', $mangaId, $tagId);
  }

  public function removeMangaTag(int $mangaId, int $tagId)
  {
    return $this->detach('tags_manga', $this->primaryKey, 'Id_tag', $mangaId, $tagId);
  }
}
