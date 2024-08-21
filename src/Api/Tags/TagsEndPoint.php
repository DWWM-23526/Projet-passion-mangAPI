<?php

namespace Api\Tags;

use Core\Base\BaseApiEndpoint;

class TagsEndpoint extends BaseApiEndpoint
{
    

    protected function getBasePath(): string
    {
        return '/api/tags';
    }

    protected function getController(): string
    {
        return 'Api\Tags\Controller\tagsController';
    }

    protected function registerRoutes()
    {
        parent::registerRoutes();

        $this->addGet('/manga/{id}', 'getAllTagsRelatedManga',);
       
    }
} 

