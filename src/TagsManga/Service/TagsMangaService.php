<?php

namespace TagsManga\Service;

use Common\Core\App;
use Favorites\Repository\FavoritesRepository;
use TagsManga\Repository\TagsMangaRepository;

class TagsMangaService
{
    private TagsMangaRepository $tagsMangaRepository;

    public function __construct()
    {
        $this->tagsMangaRepository = App::injectRepository()->getContainer(TagsMangaRepository::class);
    }

    public function getAll(): array
    {
        return $this->tagsMangaRepository->getAll();
    }

    public function getAllMangaTags(int $mangaId): array
    {
        return $this->tagsMangaRepository->getAllMangaTags($mangaId);
    }

    public function getAllTagMangas(int $tagId): array
    {
        return $this->tagsMangaRepository->getAllTagMangas($tagId);
    }


    public function createTagManga(array $tagsManga): void
    {
        $this->tagsMangaRepository->createTagManga($tagsManga);
    }

    public function deleteTagManga (array $tagsManga): void
    {
        $this->tagsMangaRepository->deleteTagManga($tagsManga);
    }
}