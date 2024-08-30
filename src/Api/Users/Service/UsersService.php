<?php

namespace Api\Users\Service;


use Api\Users\Repository\UsersRepository;
use Core\Base\BaseApiService;

class UsersService extends BaseApiService
{

    public function __construct()
    {
        parent::__construct(UsersRepository::class);
    }


    public function getAllUserRelatedManga(int $id)
    {
        return $this->repository->getAllUserRelatedManga($id);
    }

    public function addMangaToUser(int $userId, int $mangaId)
    {
        return $this->repository->addMangaToUser($userId, $mangaId);
    }

    public function removeMangaFromUser(int $userId, int $mangaId)
    {
        return $this->repository->removeMangaFromUser($userId, $mangaId);
    }
}