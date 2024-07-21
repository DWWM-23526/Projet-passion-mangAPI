<?php

namespace Api\Tags\Service;

use Core\App;
use Api\Tags\Model\Tags;
use Api\Tags\Repository\TagsRepository;

class TagsService
{
    private TagsRepository $tagsRepository;

    public function __construct()
    {
        $this->tagsRepository = App::injectRepository()->getContainer(TagsRepository::class);
    }

    public function getAllTags()
    {
        return $this->tagsRepository->getAllTags();
    }
    //TODO Corriger :
    // public function getAllRelatedManga($id)
    // {
    //     return $this->tagsRepository->getAllRelatedManga($id);
    // }

    public function getTagById(int $id)
    {
        return $this->tagsRepository->getTagById($id);
    }

    public function createTag($data)
    {
        return $this->tagsRepository->createTag($data);
    }

    public function updateTag($data, $id)
    {
        return $this->tagsRepository->updateTag($data, $id);
    }

    public function deleteTag(int $id)
    {
        return $this->tagsRepository->deleteTag($id);
    }
}
