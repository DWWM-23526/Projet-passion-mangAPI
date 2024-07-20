<?php

// GET all mangakas

use Core\RequestMethod;

$app->addRoute(RequestMethod::GET, "/api/mangaka", "Api\Mangaka\Controller\MangakaController", "getAllMangakas");

// GET mangaka by Id
$app->addRoute(RequestMethod::GET, '/api/mangaka/{mangakaId}', 'Api\Mangaka\Controller\MangakaController', 'getMangakaById');

// GET related mangas by mangaka Id
$app->addRoute(RequestMethod::GET, '/api/mangas/mangaka/{mangakaId}', 'Api\Mangaka\Controller\MangakaController', 'getAllRelatedManga');

// POST add a new manga

$app->addRoute(RequestMethod::POST, '/api/mangaka', 'Api\Mangaka\Controller\MangakaController', 'addMangaka');

// PUT update a manga

$app->addRoute(RequestMethod::PUT, '/api/mangaka/{mangakaId}', 'Api\Mangaka\Controller\MangakaController', 'updateMangaka');

// DELETE remove a manga
$app->addRoute(RequestMethod::DELETE, '/api/mangaka/{mangakaId}', 'Api\Mangaka\Controller\MangakaController', 'removeMangaka');