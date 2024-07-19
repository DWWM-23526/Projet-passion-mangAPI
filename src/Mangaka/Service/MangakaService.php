<?php

namespace Mangaka\Service;

use Core\App;
use Mangaka\Model\Mangaka;
use Mangaka\Repository\MangakaRepository;

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

  public function getMangakaById(int $id)
  {
    return $this->mangakaRepository->getMangakaById($id);
  }

  public function createMangakas(mixed $dataMangaka)
  {
    $mangaka = new Mangaka($dataMangaka);
    return $this->mangakaRepository->createMangaka($mangaka);
  }

  public function updateMangaka(mixed $dataMangaka)
  {
    $mangaka = new Mangaka($dataMangaka);
    return $this->mangakaRepository->updateMangaka($mangaka);
  }

  public function deleteMangaka(int $id)
  {
    return $this->mangakaRepository->deleteMangaka($id);
  }
}
