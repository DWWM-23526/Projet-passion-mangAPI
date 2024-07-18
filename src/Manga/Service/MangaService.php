<?php

namespace Manga\Service;

use Common\Core\App;
use Manga\Model\Manga;
use Manga\Repository\MangaRepository;

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

  public function createManga(mixed $data)
  {
    $manga = new Manga($data);
    // TODO verification de donnée
     $this->mangaRepository->createManga($manga);
  }

  public function updateManga(mixed $data)
  {
    $manga = new Manga($data);
     // TODO verification de donnée
    return $this->mangaRepository->updateManga($manga);
  }

  public function deleteManga(int $id)
  {
    return $this->mangaRepository->deleteManga($id);
  }
}
