<?php

namespace Api\Manga\Service;

use Api\Manga\Repository\MangaRepository;
use Core\Base\BaseApiService;

class MangaService extends BaseApiService
{
  public function __construct()
  {
    parent::__construct(MangaRepository::class);
  }

  public function searchMangaByName($searchTerm)
  {
    return $this->repository->searchMangaByName($searchTerm);
  }

  public function getRelatedMangaka(int $id)
  {
    return $this->repository->getRelatedMangaka($id);
  }

  public function getAllMangaRelatedTags(int $id)
  {
    return $this->repository->getAllMangaRelatedTags($id);
  }

  public function checkIfIsUserFavorite($mangaId, $userId)
  {
    $result = $this->repository->checkIfIsUserFavorite([$mangaId, $userId], ['Id_manga', 'Id_user']);
    if ($result[0]['result'] == 0) {
      $result = false;
      return $result;
    }
    $result = true;
    return $result;
  }

  public function addTagToManga(int $mangaId, int $tagId)
  {
    return $this->repository->addTagToManga($mangaId, $tagId);
  }

  public function removeMangaTag(int $mangaId, int $tagId)
  {

    return $this->repository->removeMangaTag($mangaId, $tagId);
  }
}
