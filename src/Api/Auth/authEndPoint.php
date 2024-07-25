<?php

use Core\RequestMethod;


// POST login
$app->addRoute(RequestMethod::POST, '/api/login', 'Api\Auth\Controller\AuthController', 'login');

// POST validate
$app->addRoute(RequestMethod::POST, '/api/validate', 'Api\Auth\Controller\AuthController', 'validate');


