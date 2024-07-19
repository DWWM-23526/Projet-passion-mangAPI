<?php

use Core\RequestMethod;

// Get All
$app->addRoute(RequestMethod::GET, '/api/tags', 'Tags\Controller\TagsController', 'getAllTags');

// Get by ID
$app->addRoute(RequestMethod::GET, '/api/tags/{tagId}', 'Tags\Controller\TagsController', 'getTagById');

// Create
$app->addRoute(RequestMethod::POST, '/api/tags', 'Tags\Controller\TagsController', 'addTag');

// Update 
$app->addRoute(RequestMethod::PUT,'/api/tags', 'Tags\Controller\TagsController', 'updateTag');

// Delete
$app->addRoute(RequestMethod::DELETE,'/api/tags/{tagId}', 'Tags\Controller\TagsController', 'deleteTag');
