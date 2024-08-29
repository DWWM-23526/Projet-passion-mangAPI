<?php

namespace Api\Services;

use Api\Repositories\TagsRepository as RepositoriesTagsRepository;
use Core\Services\_BaseApiService;


class TagsService extends _BaseApiService
{
    public function __construct()
    {
        parent::__construct(RepositoriesTagsRepository::class);
    }

    public function getAllTagsRelatedManga($id)
    {
        return $this->repository->getAllTagsRelated($id);
    } 

}
