<?php

namespace Api\Services;


use Api\Repositories\TagsRepository as RepositoriesTagsRepository;
use Api\Validation\TagsValidator;
use Core\Services\_BaseApiService;


class TagsService extends _BaseApiService
{
    public function __construct()
    {
        parent::__construct(RepositoriesTagsRepository::class, TagsValidator::class);
    }

    public function getAllTagsRelatedManga($id)
    {
        return $this->repository->getAllTagsRelated($id);
    } 

}
