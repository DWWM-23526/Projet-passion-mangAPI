<?php

namespace Tags\Service;

use Common\Core\App;
use Tags\Model\Tags;
use Tags\Repository\TagsRepository;

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

    public function getTagById(int $id)
    {
        return $this->tagsRepository->getTagById($id);
    }

    public function createTag(mixed $dataTag)
    {
        $tag = new Tags($dataTag);
        return $this->tagsRepository->createTag($tag);
    }

    public function updateTag(mixed $dataTag)
    {
        $tag = new Tags($dataTag);
        return $this->tagsRepository->updateTag($tag);
    }

    public function deleteTag(int $id)
    {
        return $this->tagsRepository->deleteTag($id);
    }
}
