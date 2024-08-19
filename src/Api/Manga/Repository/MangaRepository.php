<?php

namespace Api\Manga\Repository;

use Api\Manga\Model\Manga;
use Api\Mangaka\Model\Mangaka;
use Api\Tags\Model\Tags;
use Core\ORM\BaseRepository;

class MangaRepository extends BaseRepository
{
  protected $table = 'mangas';
  protected $modelClass = Manga::class;
  protected $primaryKey = 'Id_manga';

  // CRUD

  public function getAllMangas()
  {
    return $this->getAll($this->table);
  }

  public function getMangaById(int $mangaId)
  {
    return $this->getById($mangaId);
  }

  public function searchMangaByName(string $searchTerm)
  {
    return $this->search([$searchTerm],['manga_name']);
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

  public function checkIfIsUserFavorite($mangaId, $UserId){
    return $this->checkIfExists('favoris',[$mangaId, $UserId],['Id_manga', 'Id_user']);
  }

  public function addTagToManga(int $mangaId, int $tagId)
  {
    return $this->attach('tags_manga', $this->primaryKey, 'Id_tag', $mangaId, $tagId );
  }

  public function removeMangaTag(int $mangaId, int $tagId)
  {
    return $this->detach('tags_manga', $this->primaryKey, 'Id_tag', $mangaId, $tagId);
  }

  public function createManga(array $data)
  {
    return $this->create($data);
  }

  public function updateManga(array $data, int $id)
  {
    return $this->update($data, $id);
  }

  public function deleteManga($id)
  {
    return $this->delete($id, 'Id_manga');
  }
}
