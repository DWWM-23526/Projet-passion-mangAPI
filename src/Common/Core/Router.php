<?php 
namespace Core;

use Exception;

enum RequestMethod {
    case GET ;
    case POST ;
    case DELETE ;
    case PATCH ;
    case PUT ;
}

class Router
{
    

    private array $routes = [];

    public function middleware($key){
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
    }

    private function addRoute(RequestMethod $requestMethod, string $uri, string $controller, string $method){


        $this->routes[] = [
            'requestMethod' => $requestMethod->name,
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];
    }

    public function route(){
        $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $uri = urldecode($uri);
        $requestMethod = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

        foreach($this->routes as $route){
            if($route['uri'] === $uri && $route['requestMethod'] === strtoupper($requestMethod)){

                // TODO : A faire avec Middleware
                // if($route['middleware']){
                //     echo "pas par là";
                // }

                if(class_exists($route['controller'])){
                    $controller = new $route['controller'];
                    $method = $route['method'];
                    if(method_exists($controller, $method)){
                        $controller->$method();
                        return;
                    } else {
                        throw new Exception(" method {$method} not trouved in class {$controller}");
                    }
                } else {
                    throw new Exception("class {$route['controller']} does not exist");
                }

            }
        }
        // HTTPRequest::abord();
    }
}

