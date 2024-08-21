<?php

namespace Api\Manga;

use Core\Base\BaseApiEndpoint;

class MangaEndpoint extends BaseApiEndpoint
{

    protected function getBasePath(): string
    {
        return '/api/manga';
    }

    protected function getController(): string
    {
        return 'Api\Manga\Controller\MangaController';
    }


    protected function registerRoutes()
    {
        parent::registerRoutes();

        $this->addGet('/search/{searchTerm}', 'searchMangaByName',);
        $this->addGet('/mangaka/{id}', 'getRelatedMangaka');
        $this->addGet('/tags/{id}', 'getAllMangaRelatedTags');
        $this->addGet('/user/{id}/{userId}', 'checkIfIsUserFavorite', 'auth');
        $this->addPost('/tags/{id}/{tagId}', 'addTagToManga', 'auth');
        $this->addDelete('/tags/{id}/{tagId}', 'removeMangaTag', 'auth');
    }
}
