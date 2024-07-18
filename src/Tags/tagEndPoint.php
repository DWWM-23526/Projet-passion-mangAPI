<?php

use Common\Core\RequestMethod;

$app->addRoute(RequestMethod::GET, '/api/tags', 'Tags\Controller\TagsController', 'getAllTags');
$app->addRoute(RequestMethod::GET, '/api/tags/{tagId}', 'Tags\Controller\TagsController', 'getTagById');
$app->addRoute(RequestMethod::POST, '/api/tags', 'Tags\Controller\TagsController', 'addTag');

