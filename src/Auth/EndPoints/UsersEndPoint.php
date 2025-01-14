<?php

namespace Auth\Endpoints;

use Core\EndPoints\_BaseApiEndpoint;


class UsersEndpoint extends _BaseApiEndpoint
{

    protected function getBasePath(): string
    {
        return '/api/users';
    }

    protected function getController(): string
    {
        return 'Auth\Controllers\UsersController';
    }

    protected function registerRoutes()
    {
        parent::registerRoutes();

        $this->addGet('/manga/{id}', 'getAllUserRelatedManga', 'auth');
        $this->addPost('/manga/{id}/{mangaId}', 'addMangaToUser', 'auth');
        $this->addDelete('/manga/{id}/{mangaId}', 'removeMangaFromUser', 'auth');
        $this->addGet('/role', 'getAllRole', 'admin');
    }
}