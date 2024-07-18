<?php

use Common\Core\RequestMethod;

$app->addRoute(RequestMethod::GET, '/api/users', 'Users\Controller\UsersController', 'getAllUsers');
$app->addRoute(RequestMethod::GET, '/api/users/{user_id}', 'Users\Controller\UsersController', 'getAllUsers');
$app->addRoute(RequestMethod::POST, '/api/users', 'Users\Controller\UsersController', 'getAllUsers');