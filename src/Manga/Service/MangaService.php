<?php

namespace Manga\Service;

use Common\Core\App;
use Common\Core\Database;
use Manga\Model\Manga;
use Manga\Repository\MangaRepository;

class MangaService
{
  private MangaRepository $mangaRepository;

  public function __construct()
  {
    $this->mangaRepository = App::inject()->getContainer(Database::class);
  }

  public function getAllMangas()
  {
    return $this->mangaRepository->getAllMangas();
  }

  public function getMangaById(int $id)
  {
    return $this->mangaRepository->getMangaById($id);
  }

  public function createManga(Manga $manga)
  {
    return $this->mangaRepository->createManga($manga);
  }

  public function updateManga(Manga $manga)
  {
    return $this->mangaRepository->updateManga($manga);
  }

  public function deleteManga(int $id)
  {
    return $this->mangaRepository->deleteManga($id);
  }
}
