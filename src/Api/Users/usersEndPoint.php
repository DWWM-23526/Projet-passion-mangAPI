<?php

use Core\RequestMethod;

// Get All
$app->addRoute(RequestMethod::GET, '/api/users', 'Api\Users\Controller\UsersController', 'getAllUsers')->middleware('auth');

// Get User by ID
$app->addRoute(RequestMethod::GET, '/api/users/{UserId}', 'Api\Users\Controller\UsersController', 'getUserById')->middleware('auth');

// GET All user related manga
$app->addRoute(RequestMethod::GET, '/api/users/login', 'Api\Users\Controller\UsersController', 'login')->middleware('auth');


// GET All user related manga
$app->addRoute(RequestMethod::GET, '/api/users/manga/{UserId}', 'Api\Users\Controller\UsersController', 'getAllUserRelatedManga')->middleware('auth');

// POST add new manga to user
$app->addRoute(RequestMethod::POST, '/api/users/manga/{UserId}/{mangaId}', 'Api\Users\Controller\UsersController', 'addMangaToUser')->middleware('auth');

// Add User
$app->addRoute(RequestMethod::POST, '/api/users', 'Api\Users\Controller\UsersController', 'addUser')->middleware('auth');

// Update User by ID
$app->addRoute(RequestMethod::PUT, '/api/users/{UserId}', 'Api\Users\Controller\UsersController', 'updateUser')->middleware('auth');

// Delete User by ID
$app->addRoute(RequestMethod::DELETE, '/api/users/{UserId}', 'Api\Users\Controller\UsersController', 'deleteUser')->middleware('auth');

// DELETE manga from user
$app->addRoute(RequestMethod::DELETE, '/api/users/manga/{UserId}/{mangaId}', 'Api\Users\Controller\UsersController', 'removeMangaFromUser')->middleware('auth');
