<?php

namespace Api\Auth;

use Api\EndPoints\_BaseApiEndpoint;

class AuthEndpoint extends _BaseApiEndpoint
{

    protected function getBasePath(): string
    {
        return '/api';
    }

    protected function getController(): string
    {
        return 'Api\Auth\Controller\AuthController';
    }

    protected function registerRoutes()
    {
        $this->addPost('/login', 'login', 'guest');
        $this->addPost('/validate', 'validate', 'auth');
        $this->addPost('/permission', 'takeIdRoleInToken', 'admin');
    }
}