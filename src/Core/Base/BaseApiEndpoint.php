<?php

namespace Core\Base;

use Core\RequestMethod;

abstract class BaseApiEndpoint
{

    protected $basePath;
    protected $controller;

    protected function __construct(string $basePath, string $controller)
    {
        $this->basePath = $basePath;
        $this->controller = $controller;
    }

    protected function addRoute(RequestMethod $httpMethod, string $route, string $method, string $middleware = null)
    {
        $app = \Core\Router::getInstance();
        $route = $this->basePath . rtrim($route, '/');

        if ($middleware !== null) {
            $app->middleware($middleware);
        }

        $app->addRoute($httpMethod, $route, $this->controller, $method);
       
    }

    protected function addGet(string $route, string $method, string $middleware = null)
    {
        $this->addRoute(\Core\RequestMethod::GET, $route, $method, $middleware);
    }

    protected function addPost(string $route, string $method, string $middleware = null)
    {
        $this->addRoute(\Core\RequestMethod::POST, $route, $method, $middleware);
    }

    protected function addPut(string $route, string $method, string $middleware = null)
    {
        $this->addRoute(\Core\RequestMethod::PUT, $route, $method, $middleware);
    }

    protected function addDelete(string $route, string $method, string $middleware = null)
    {
        $this->addRoute(\Core\RequestMethod::DELETE, $route, $method, $middleware);
    }

    protected function registerRoutes()
    {
        $this->addGet('/', 'getAll');
        $this->addGet('/{id}', 'getById');
        $this->addPost('/', 'create', 'auth');
        $this->addPut('/{id}', 'update', 'auth');
        $this->addDelete('/{id}', 'delete', 'auth');

        
    }


    public static function create(string $basePath, string $controller)
    {
        $instance = new static($basePath, $controller);
        $instance->registerRoutes();
        return $instance;
    }
}
