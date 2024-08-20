<?php

use Core\RequestMethod;

// Get All
$app->addRoute(RequestMethod::GET, '/api/users', 'Api\Users\Controller\UsersController', 'getAll')->middleware('auth');

// Get User by ID
$app->addRoute(RequestMethod::GET, '/api/users/{id}', 'Api\Users\Controller\UsersController', 'getById')->middleware('auth');

// GET All user related manga
$app->addRoute(RequestMethod::GET, '/api/users/login', 'Api\Users\Controller\UsersController', 'login')->middleware('auth');


// GET All user related manga
$app->addRoute(RequestMethod::GET, '/api/users/manga/{id}', 'Api\Users\Controller\UsersController', 'getAllUserRelatedManga')->middleware('auth');

// POST add new manga to user
$app->addRoute(RequestMethod::POST, '/api/users/manga/{id}/{mangaId}', 'Api\Users\Controller\UsersController', 'addMangaToUser')->middleware('auth');

// Add User
$app->addRoute(RequestMethod::POST, '/api/users', 'Api\Users\Controller\UsersController', 'create')->middleware('auth');

// Update User by ID
$app->addRoute(RequestMethod::PUT, '/api/users/{id}', 'Api\Users\Controller\UsersController', 'update')->middleware('auth');

// Delete User by ID
$app->addRoute(RequestMethod::DELETE, '/api/users/{id}', 'Api\Users\Controller\UsersController', 'delete')->middleware('auth');

// DELETE manga from user
$app->addRoute(RequestMethod::DELETE, '/api/users/manga/{id}/{mangaId}', 'Api\Users\Controller\UsersController', 'removeMangaFromUser')->middleware('auth');
