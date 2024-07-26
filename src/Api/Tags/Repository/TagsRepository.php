<?php

namespace Api\Tags\Repository;

use Api\Manga\Model\Manga;
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
        return $this->getById($tagsId);
    }

    public function createTag($data)
    {
        return $this->create($data);
    }

    public function updateTag($data, $id)
    {
        return $this->update($data, $id);
    }

    public function getAllTagsRelated(int $tagsId)
    {
        return $this->belongToMany(Manga::class, 'mangas', 'tags_manga', 'Id_manga', $tagsId);
    }

    public function deleteTag($id)
    {
        return $this->delete($id, 'Id_tag');
    }
}
