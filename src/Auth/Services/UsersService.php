<?php

namespace Auth\Services;

use Auth\Repositories\UsersRepository;
use Api\Services\_BaseApiService;



class UsersService extends _BaseApiService
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