<?php

namespace Core;

use Core\Middlewares\_BaseMiddleware;
use Core\HTTPRequest;
use Core\HTTPResponse;
use Exception;

enum RequestMethod
{
    case GET;
    case POST;
    case DELETE;
    case PATCH;
    case PUT;
}

class Router
{
    private static ?Router $instance = null;
    private array $routes = [];
    private ?string $middleware = null;

    private function __construct() {}

    public static function getInstance(): Router
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function middleware($key)
    {
        $this->middleware = $key;
        return $this;
    }

    public function addRoute(RequestMethod $requestMethod, string $uri, string $controller, string $method)
    {
        $uri = rtrim($uri, '/');

        foreach ($this->routes as &$route) {
            if ($route['uri'] === $uri && $route['requestMethod'] === $requestMethod->name) {
                $route['controller'] = $controller;
                $route['method'] = $method;
                $route['middleware'] = $this->middleware; 
                $this->middleware = null;
                return $this;
            }

        }

        $this->routes[] = [
            'requestMethod' => $requestMethod->name,
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => $this->middleware
        ];

        $this->middleware = null;
        return $this;
    }

    public function route()
    {
        $request = HTTPRequest::getInstance();
        $response = HTTPResponse::getInstance();
        $uri = $request->getUri();
        $requestMethod = $request->getMethod();

        foreach ($this->routes as $route) {
            if ($route['requestMethod'] === strtoupper($requestMethod)) {
                $params = $this->matchUri($route['uri'], $uri);
                if ($params !== null) {

                    if ($route['middleware']) {
                        $middleware = _BaseMiddleware::MAP[$route['middleware']];
                        (new $middleware)->handle($request, $response);
                    }


                    if (class_exists($route['controller'])) {
                        $controller = new $route['controller'];
                        $method = $route['method'];
                        if (method_exists($controller, $method)) {
                            $controller->$method($request, $response, $params);
                            return;
                        } else {
                            throw new Exception("Method {$method} not found in class {$route['controller']}");
                        }
                    } else {
                        throw new Exception("Class {$route['controller']} does not exist");
                    }
                }
            }
        }

        HTTPResponse::abort(404);
    }

    private function matchUri(string $routeUri, string $requestUri): ?array
    {
        $routeParts = explode('/', $routeUri);
        $requestParts = explode('/', $requestUri);

        if (count($routeParts) !== count($requestParts)) {
            return null;
        }

        $params = [];
        foreach ($routeParts as $index => $part) {
            if (preg_match('/^\{(\w+)\}$/', $part, $matches)) {
                $params[$matches[1]] = $requestParts[$index];
            } elseif ($part !== $requestParts[$index]) {
                return null;
            }
        }
        return $params;
    }
}
