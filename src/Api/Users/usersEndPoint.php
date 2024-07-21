<?php

use Core\RequestMethod;

// Get All
$app->addRoute(RequestMethod::GET, '/api/users', 'Api\Users\Controller\UsersController', 'getAllUsers');

// Get User by ID
$app->addRoute(RequestMethod::GET, '/api/users/{UserId}', 'Api\Users\Controller\UsersController', 'getUserById');

// GET All user related manga
$app->addRoute(RequestMethod::GET, '/api/users/manga/{UserId}', 'Api\Users\Controller\UsersController', 'getAllUserRelatedManga');

// POST add new manga to user
$app->addRoute(RequestMethod::POST, '/api/users/manga/{UserId}/{mangaId}', 'Api\Users\Controller\UsersController', 'addMangaToUser');

// Add User
$app->addRoute(RequestMethod::POST, '/api/users', 'Api\Users\Controller\UsersController', 'addUser');

// Update User by ID
$app->addRoute(RequestMethod::PUT, '/api/users/{UserId}', 'Api\Users\Controller\UsersController', 'updateUser');

// Delete User by ID
$app->addRoute(RequestMethod::DELETE, '/api/users/{UserId}', 'Api\Users\Controller\UsersController', 'deleteUser');

// DELETE manga from user
$app->addRoute(RequestMethod::DELETE, '/api/users/manga/{UserId}/{mangaId}', 'Api\Users\Controller\UsersController', 'removeMangaFromUser');
