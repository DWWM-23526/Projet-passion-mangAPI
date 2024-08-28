<?php

header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
header('Access-Control-Expose-Headers: X-Total-Count');
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, X-Total-Count, Range");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit; // Répondre immédiatement aux requêtes OPTIONS
}

use Core\App;

session_start(); 

require __DIR__ . '/../vendor/autoload.php';

spl_autoload_register(function ($class){
    $result = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require __DIR__ . "/../src/{$result}.php";
});

$app = App::init();
$app->route();