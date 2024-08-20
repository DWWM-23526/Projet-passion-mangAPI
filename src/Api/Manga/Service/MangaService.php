<?php

namespace Api\Manga\Service;

use Core\App;
use Api\Manga\Repository\MangaRepository;
use Core\Base\BaseApiService;

class MangaService extends BaseApiService
{
    public function __construct()
    {
        parent::__construct(MangaRepository::class);
    }

    // Ajoutez ici les méthodes spécifiques à MangaService si nécessaire
}

// class MangaService
// {
//   private MangaRepository $mangaRepository;

//   public function __construct()
//   {
//     return $this->mangaRepository = App::injectRepository()->getContainer(MangaRepository::class);
//   }

//   public function getAllMangas()
//   {
//     return $this->mangaRepository->getAllMangas();
//   }

//   public function searchMangaByName($searchTerm)
//   {
//     return $this->mangaRepository->searchMangaByName($searchTerm);
//   }

//   public function getRelatedMangaka(int $id)
//   {
//     return $this->mangaRepository->getRelatedMangaka($id);
//   }

//   public function getAllMangaRelatedTags(int $id)
//   {
//     return $this->mangaRepository->getAllMangaRelatedTags($id);
//   }

//   public function checkIfIsUserFavorite(int $userId, int $mangaId){
//     return $this->mangaRepository->checkIfIsUserFavorite($mangaId,$userId);
//   }

//   public function addTagToManga(int $mangaId, int $tagId)
//   {
//     return $this->mangaRepository->addTagToManga($mangaId, $tagId);
//   }

//   public function removeMangaTag(int $mangaId, int $tagId)
//   {

//     return $this->mangaRepository->removeMangaTag($mangaId, $tagId);
//   }

//   public function getMangaById(int $id)
//   {
//     return $this->mangaRepository->getMangaById($id);
//   }

//   public function createManga($data)
//   {
//     return $this->mangaRepository->createManga($data);
//   }

//   public function updateManga($data, $id)
//   {
//     return $this->mangaRepository->updateManga($data, $id);
//   }

//   public function deleteManga($id)
//   {
//     return $this->mangaRepository->deleteManga($id);
//   }
// }
