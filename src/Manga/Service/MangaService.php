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

  public function createManga(array $data)
  {
    $manga = new Manga($data);
    if ($this->mangaRepository->mangaExists($manga->manga_name)) {
      throw new \Exception("Manga already exist");
    }
     $this->mangaRepository->createManga($manga);
  }

  public function updateManga(array $data)
  {
    $manga = new Manga($data);
    if (!$this->mangaRepository->mangaExists($manga->manga_name)) {
      throw new \Exception("Manga does not exist");
    }
    return $this->mangaRepository->updateManga($manga);
  }

  public function deleteManga(int $id)
  {
    return $this->mangaRepository->deleteManga($id);
  }
}
