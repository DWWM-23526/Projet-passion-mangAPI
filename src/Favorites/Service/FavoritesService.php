<?php

namespace Favorites\Service;

use Common\Core\App;
use Favorites\Repository\FavoritesRepository;


class FavoritesService
{
    private FavoritesRepository $favoritesRepository;

    public function __construct()
    {
        $this->favoritesRepository = App::injectRepository()->getContainer(FavoritesRepository::class);
    }

    public function getAllFavorites(): array
    {
        return $this->favoritesRepository->getAllFavorites();
    }

    public function getAllUserFavorites(int $userId): ?array
    {
        return $this->favoritesRepository->getAllUserFavoritesByUserId($userId);
    }

    public function addFavorite(array $data): void
    {
        $this->favoritesRepository->createFavorites($data);
    }

    public function deleteFavorite(int $userId, int $mangaId): void
    {
        $this->favoritesRepository->deleteFavorites($userId, $mangaId);
    }
}