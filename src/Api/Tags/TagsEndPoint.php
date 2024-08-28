<?php

namespace Api\Tags;

use Api\EndPoints\_BaseApiEndpoint;

class TagsEndpoint extends _BaseApiEndpoint
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

