<?php

namespace Api\Mangaka\Service;

use Api\Mangaka\Repository\MangakaRepository;
use Core\Base\BaseApiService;

class MangakaService extends BaseApiService
{
  public function __construct()
  {
    parent::__construct(MangakaRepository::class);
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
