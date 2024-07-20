<?php

use Core\RequestMethod;

// GET all mangas
$app->addRoute(RequestMethod::GET, "/api/manga", "Api\Manga\Controller\MangaController", "getAllMangas");

// GET manga by ID
$app->addRoute(RequestMethod::GET, '/api/manga/{mangaId}', 'Api\Manga\Controller\MangaController', 'getMangaById');

// GET related mangaka by manga by ID
$app->addRoute(RequestMethod::GET, '/api/manga/mangaka/{mangaId}', 'Api\Manga\Controller\MangaController', 'getRelatedMangaka');

// POST add a new manga
$app->addRoute(RequestMethod::POST, '/api/manga', 'Api\Manga\Controller\MangaController', 'addManga');

// PUT update a manga

$app->addRoute(RequestMethod::PUT, '/api/manga/{mangaId}', 'Api\Manga\Controller\MangaController', 'updateManga');

// DELETE remove a manga
$app->addRoute(RequestMethod::DELETE, '/api/manga/{mangaId}', 'Api\Manga\Controller\MangaController', 'removeManga');
