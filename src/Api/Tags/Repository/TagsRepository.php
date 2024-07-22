<?php

namespace Api\Tags\Repository;


use Api\Tags\Model\Tags;
use Core\ORM\BaseRepository;

class TagsRepository extends BaseRepository
{
    protected $table = "tags";

    protected $modelClass = Tags::class;

    protected $primaryKey = 'Id_tag';

    public function getAllTags()
    {
        return $this->getAll($this->table);
    }

    public function getTagById(int $tagsId)
    {
        return $this->getBy($tagsId, $this->primaryKey);
    }

    public function createTag($data)
    {
        return $this->create($data);
    }

    public function updateTag($data, $id)
    {
        return $this->update($data, $id);
    }

    public function deleteTag($id)
    {
        return $this->delete($id, 'Id_tag');
    }
}
