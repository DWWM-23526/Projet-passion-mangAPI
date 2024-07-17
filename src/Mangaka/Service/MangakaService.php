<?php

namespace Mangaka\Service;

use Common\Core\App;

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

  public function getMangakasById(int $id)
  {
    return $this->mangakaRepository->getMangakaById($id);
  }

  public function createMangakas(Mangaka $mangaka)
  {
    return $this->mangakaRepository->createMangaka($mangaka);
  }

  public function updateMangaka(Mangaka $mangaka)
  {
    return $this->mangakaRepository->updateMangaka($mangaka);
  }

  public function deleteMangaka(int $id)
  {
    return $this->mangakaRepository->deleteMangaka($id);
  }
}
