<?php

namespace Api\Users;

use Api\EndPoints\_BaseApiEndpoint;


class UsersEndpoint extends _BaseApiEndpoint
{

    protected function getBasePath(): string
    {
        return '/api/users';
    }

    protected function getController(): string
    {
        return 'Api\Users\Controller\UsersController';
    }

    protected function registerRoutes()
    {
        parent::registerRoutes();

        $this->addGet('/manga/{id}', 'getAllUserRelatedManga', 'auth');
        $this->addGet('/manga/{id}/{mangaId}', 'addMangaToUser', 'auth');
        $this->addDelete('/manga/{id}/{mangaId}', 'removeMangaFromUser', 'auth');
        $this->addGet('/role', 'getAllRole', 'admin');
    }
}