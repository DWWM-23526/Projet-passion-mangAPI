<?php

namespace Api\Auth;

use Core\Base\BaseApiEndpoint;

class AuthEndpoint extends BaseApiEndpoint
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
        $this->addGet('/permission', 'takeIdRoleInToken');
    }
}


