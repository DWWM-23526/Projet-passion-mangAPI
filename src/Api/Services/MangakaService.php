<?php

namespace Api\Services;

use Api\Repositories\MangakaRepository;
use Api\Validation\MangakaValidator;
use Core\Services\_BaseApiService;


class MangakaService extends _BaseApiService
{
  public function __construct()
  {
    parent::__construct(MangakaRepository::class, MangakaValidator::class);
  }

  public function searchMangakaByName($searchTerm)
  {

    $searchTermParts = explode(' ', $searchTerm);

    return $this->repository->searchMangakaByName($searchTermParts);
  }

  public function getAllRelatedManga($id)
  {
    return $this->repository->getAllRelatedManga($id);
  }
}
