<?php

namespace Api\Repositories;

use Api\Models\Manga;
use Api\Models\Tags;
use Api\repositories\_BaseApiRepository;



class TagsRepository extends _BaseApiRepository
{
    protected $table = "tags";
    protected $modelClass = Tags::class;
    protected $primaryKey = 'Id_tag';

  
    public function getAllTagsRelated(int $tagsId)
    {
        return $this->belongToMany(Manga::class, 'mangas', 'tags_manga', 'Id_manga', $tagsId);
    }
}
