<?php

use Core\RequestMethod;


// POST login
$app->addRoute(RequestMethod::POST, '/api/login', 'Api\Auth\Controller\AuthController', 'login')->middleware('guest');

// POST validate
$app->addRoute(RequestMethod::POST, '/api/validate', 'Api\Auth\Controller\AuthController', 'validate')->middleware('auth');


