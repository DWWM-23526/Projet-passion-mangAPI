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

    public function addFavorite(array $favoriteData): void
    {
        $this->validateFavoriteData($favoriteData);

        $this->favoritesRepository->createFavorites($favoriteData);
    }

    public function updateFavorite(array $favoriteData): void
    {
        $this->validateFavoriteData($favoriteData);

        $this->favoritesRepository->updateFavorites($favoriteData);
    }

    public function removeFavorite(array $favoriteData): void
    {
        $this->validateFavoriteData($favoriteData);

        $this->favoritesRepository->deleteFavorites($favoriteData);
    }

    private function validateFavoriteData(array $favoriteData): void
    {
        if (!isset($favoriteData['Id_manga']) || !isset($favoriteData['Id_user'])) {
            throw new \InvalidArgumentException('Id_manga and Id_user must be provided.');
        }

        if (!is_int($favoriteData['Id_manga']) || $favoriteData['Id_manga'] <= 0) {
            throw new \InvalidArgumentException('Id_manga must be a positive integer.');
        }

        if (!is_int($favoriteData['Id_user']) || $favoriteData['Id_user'] <= 0) {
            throw new \InvalidArgumentException('Id_user must be a positive integer.');
        }
    }
}