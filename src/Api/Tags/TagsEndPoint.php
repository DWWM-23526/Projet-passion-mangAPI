<?php

namespace Api\Tags;

use Core\Base\BaseApiEndpoint;

class TagsEndpoint extends BaseApiEndpoint
{
    public function __construct()
    {
        parent::__construct('/api/tags', 'Api\Tags\Controller\tagsController');
    }

    protected function registerRoutes()
    {
        parent::registerRoutes();

        $this->addGet('/manga/{id}', 'getAllTagsRelatedManga',);
       
    }
} 

