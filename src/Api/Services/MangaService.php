<?php

namespace Api\Services;

use Api\Repositories\MangaRepository;
use Core\Services\_BaseApiService;

class MangaService extends _BaseApiService
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

  public function checkIfIsUserFavorite(int $userId, int $mangaId)
  {
    return $this->repository->checkIfIsUserFavorite($mangaId, $userId);
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
