<?php

use Core\RequestMethod;

// Get All
$app->addRoute(RequestMethod::GET, '/api/users', 'Api\Users\Controller\UsersController', 'getAllUsers');

// Get User by ID
$app->addRoute(RequestMethod::GET, '/api/users/{UserId}', 'Api\Users\Controller\UsersController', 'getUserById');

// Add User
$app->addRoute(RequestMethod::POST, '/api/users', 'Api\Users\Controller\UsersController', 'addUser');

// Update User by ID
$app->addRoute(RequestMethod::PUT, '/api/users/test/{UserId}/', 'Api\Users\Controller\UsersController', 'updateUser');

// Delete User by ID
$app->addRoute(RequestMethod::PUT, '/api/users/{UserId}', 'Api\Users\Controller\UsersController', 'deleteUser');