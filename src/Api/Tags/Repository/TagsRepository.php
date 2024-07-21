<?php

namespace Api\Tags\Repository;

use Api\Manga\Model\Manga;
use Api\Tags\Model\Tags;
use Core\ORM\Repository;

class TagsRepository extends Repository
{
    protected $table = "tags";

    protected $modelClass = Tags::class;

    protected $primaryKey = 'Id_tag';

    public function getAllTags()
    {
        return $this->getAll();
    }

    public function getTagById(int $tagsId)
    {
        return $this->getBy($tagsId, $this->primaryKey);
    }
    // TODO Corriger :
    // public function getAllRelatedManga($id)
    // {
    //     return $this->hasMany(Manga::class, 'mangas', $this->primaryKey, $id);
    // }

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
