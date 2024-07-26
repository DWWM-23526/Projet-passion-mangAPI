<?php

use Core\RequestMethod;

// Get All
$app->addRoute(RequestMethod::GET, '/api/tags', 'Api\Tags\Controller\TagsController', 'getAllTags');

// Get by ID
$app->addRoute(RequestMethod::GET, '/api/tags/{tagId}', 'Api\Tags\Controller\TagsController', 'getTagById');

// GET All related tags_manga
$app->addRoute(RequestMethod::GET, '/api/tags/manga/{tagId}', 'Api\Tags\Controller\TagsController', 'getAllTagsRelatedManga');

// Create
$app->addRoute(RequestMethod::POST, '/api/tags', 'Api\Tags\Controller\TagsController', 'addTag');

// Update 
$app->addRoute(RequestMethod::PUT, '/api/tags/{tagId}', 'Api\Tags\Controller\TagsController', 'updateTag');

// Delete
$app->addRoute(RequestMethod::DELETE, '/api/tags/{tagId}', 'Api\Tags\Controller\TagsController', 'deleteTag');
