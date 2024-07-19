<?php

use Core\App;

session_start(); 

require __DIR__ . '/../vendor/autoload.php';

spl_autoload_register(function ($class){
    $result = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require __DIR__ . "/../src/{$result}.php";
});

$app = App::init();
$app->route();