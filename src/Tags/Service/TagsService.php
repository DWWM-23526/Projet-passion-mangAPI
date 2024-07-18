<?php

namespace Tags\Service;

use Common\Core\App;
use Common\Core\Database;
use Tags\Repository\TagsRepository;

class TagsService{
    private TagsRepository $tagsRepository;

    public function __construct(){
        $this->tagsRepository = App::injectRepository()->getContainer(TagsRepository::class);
    }



}