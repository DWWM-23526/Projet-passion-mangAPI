<?php

use Core\RequestMethod;

// Get All
$app->addRoute(RequestMethod::GET, '/api/users', 'Users\Controller\UsersController', 'getAllUsers');

// Get User by ID
$app->addRoute(RequestMethod::GET, '/api/users/{UserId}', 'Users\Controller\UsersController', 'getUserById');

// Add User
$app->addRoute(RequestMethod::POST, '/api/users', 'Users\Controller\UsersController', 'addUser');

// Update User by ID
$app->addRoute(RequestMethod::PUT, '/api/users/{UserId}', 'Users\Controller\UsersController', 'updateUser');

// Delete User by ID
$app->addRoute(RequestMethod::PUT, '/api/users/{UserId}', 'Users\Controller\UsersController', 'deleteUser');