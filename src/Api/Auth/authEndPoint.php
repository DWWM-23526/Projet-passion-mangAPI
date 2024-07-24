<?php

use Core\RequestMethod;


// POST login
$app->addRoute(RequestMethod::POST, '/api/login', 'Api\Auth\Controller\AuthController', 'login');


