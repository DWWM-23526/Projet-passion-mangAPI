<?php

use Common\Core\Database;


require __DIR__ . '/../vendor/autoload.php';

spl_autoload_register(function ($class){
    $result = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require __DIR__ . "/../src/{$result}.php";
});


$config = require_once __DIR__ . '/../config/db.config.php';

Database::getInstance($config['database']);