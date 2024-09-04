<?php

namespace Api\Endpoints;

use Core\EndPoints\_BaseApiEndpoint;

class TagsEndpoint extends _BaseApiEndpoint
{


    protected function getBasePath(): string
    {
        return '/api/tags';
    }

    protected function getController(): string
    {
        return 'Api\Controllers\tagsController';
    }

    protected function registerRoutes()
    {
        parent::registerRoutes();

        $this->addGet('/manga/{id}', 'getAllTagsRelatedManga',);
    }
}
