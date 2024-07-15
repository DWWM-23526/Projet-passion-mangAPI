<?php

use Common\Core\RequestMethod;
use Common\Core\Router;

require __DIR__ . '/../vendor/autoload.php';

spl_autoload_register(function ($class){
    $result = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require __DIR__ . "/../src/{$result}.php";
});


// $router = new Router();
// $router->addRoute(RequestMethod::GET,"/",'Manga\Controller\MangaController','index');
// $router->route();