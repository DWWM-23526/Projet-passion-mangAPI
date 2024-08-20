<?php

namespace Api\Tags\Service;


use Api\Tags\Repository\TagsRepository;
use Core\Base\BaseApiService;

class TagsService extends BaseApiService
{
    public function __construct()
    {
        parent::__construct(TagsRepository::class);
    }

    public function getAllTagsRelatedManga($id)
    {
        return $this->repository->getAllTagsRelated($id);
    } 

}
