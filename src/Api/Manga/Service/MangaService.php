<?php

namespace Api\Manga\Service;

use Core\App;
use Api\Manga\Model\Manga;
use Api\Manga\Repository\MangaRepository;

class MangaService
{
  private MangaRepository $mangaRepository;

  public function __construct()
  {
    $this->mangaRepository = App::injectRepository()->getContainer(MangaRepository::class);
  }

  public function getAllMangas()
  {
    return $this->mangaRepository->getAllMangas();
  }

  public function getMangaById(int $id)
  {
    return $this->mangaRepository->getMangaById($id);
  }

  public function createManga($data)
  {
    $this->mangaRepository->createManga($data);
  }

  public function updateManga($data, $id)
  {
    return $this->mangaRepository->updateManga($data, $id);
  }

  public function deleteManga($id)
  {
    return $this->mangaRepository->deleteManga($id);
  }
}
