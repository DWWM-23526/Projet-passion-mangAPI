<?php

use Core\RequestMethod;

// Get All
$app->addRoute(RequestMethod::GET, '/api/tags', 'Api\Tags\Controller\TagsController', 'getAll');

// Get by ID
$app->addRoute(RequestMethod::GET, '/api/tags/{id}', 'Api\Tags\Controller\TagsController', 'getById');

// GET All related tags_manga
$app->addRoute(RequestMethod::GET, '/api/tags/manga/{id}', 'Api\Tags\Controller\TagsController', 'getAllTagsRelatedManga');

// Create
$app->addRoute(RequestMethod::POST, '/api/tags', 'Api\Tags\Controller\TagsController', 'create')->middleware('auth');

// Update 
$app->addRoute(RequestMethod::PUT,'/api/tags/{id}', 'Api\Tags\Controller\TagsController', 'update')->middleware('auth');

// Delete
$app->addRoute(RequestMethod::DELETE,'/api/tags/{id}', 'Api\Tags\Controller\TagsController', 'delete')->middleware('auth');
