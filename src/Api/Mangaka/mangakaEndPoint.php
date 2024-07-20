<?php

// GET all mangakas

use Core\RequestMethod;

$app->addRoute(RequestMethod::GET, "/api/mangaka", "Api\Mangaka\Controller\MangakaController", "getAllMangakas");

// GET manga by Id
$app->addRoute(RequestMethod::GET, '/api/mangaka/{mangakaId}', 'Api\Mangaka\Controller\MangakaController', 'getMangakaById');

// POST add a new manga

$app->addRoute(RequestMethod::POST, '/api/mangaka', 'Api\Mangaka\Controller\MangakaController', 'addMangaka');

// PUT update a manga

$app->addRoute(RequestMethod::PUT, '/api/mangaka/{mangakaId}', 'Api\Mangaka\Controller\MangakaController', 'updateMangaka');

// DELETE remove a manga
$app->addRoute(RequestMethod::DELETE, '/api/mangaka/{mangakaId}', 'Api\Mangaka\Controller\MangakaController', 'removeMangaka');