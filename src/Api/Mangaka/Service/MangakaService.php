<?php

namespace Api\Mangaka\Service;

use Core\App;
use Api\Mangaka\Model\Mangaka;
use Api\Mangaka\Repository\MangakaRepository;

class MangakaService
{
  private MangakaRepository $mangakaRepository;

  public function __construct()
  {
    $this->mangakaRepository = App::injectRepository()->getContainer(MangakaRepository::class);
  }

  public function getAllMangakas()
  {
    return $this->mangakaRepository->getAllMangakas();
  }

  public function getAllRelatedManga($id)
  {
    return $this->mangakaRepository->getAllRelatedManga($id);
  }

  public function getMangakaById(int $id)
  {
    return $this->mangakaRepository->getMangakaById($id);
  }

  public function createMangakas($data)
  {
    return $this->mangakaRepository->createMangaka($data);
  }

  public function updateMangaka($data, $id)
  {
    return $this->mangakaRepository->updateMangaka($data, $id);
  }

  public function deleteMangaka($id)
  {
    return $this->mangakaRepository->deleteMangaka($id);
  }
}
