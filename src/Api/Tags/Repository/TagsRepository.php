<?php

namespace Api\Tags\Repository;

use Api\Manga\Model\Manga;
use Api\Tags\Model\Tags;
use Core\Base\BaseApiRepository;

class TagsRepository extends BaseApiRepository
{
    protected $table = "tags";
    protected $modelClass = Tags::class;
    protected $primaryKey = 'Id_tag';

  
    public function getAllTagsRelated(int $tagsId)
    {
        return $this->belongToMany(Manga::class, 'mangas', 'tags_manga', 'Id_manga', $tagsId);
    }
}
