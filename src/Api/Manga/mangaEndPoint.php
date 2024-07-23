<?php

use Core\RequestMethod;

// GET all mangas
$app->addRoute(RequestMethod::GET, "/api/manga", "Api\Manga\Controller\MangaController", "getAllMangas");


// GET manga by ID
$app->addRoute(RequestMethod::GET, '/api/manga/{mangaId}', 'Api\Manga\Controller\MangaController', 'getMangaById');


// GET related mangaka by manga by ID
$app->addRoute(RequestMethod::GET, '/api/manga/mangaka/{mangaId}', 'Api\Manga\Controller\MangaController', 'getRelatedMangaka');


// GET  All manga related tags by manga by ID
$app->addRoute(RequestMethod::GET, '/api/manga/tags/{mangaId}', 'Api\Manga\Controller\MangaController', 'getAllMangaRelatedTags');

// GET if is favorite from one User
$app->addRoute(RequestMethod::GET, '/api/manga/user/{mangaId}/{userId}', 'Api\Manga\Controller\MangaController', 'checkIfIsUserFavorite');


// POST add new tag to  manga
$app->addRoute(RequestMethod::POST, '/api/manga/tags/{mangaId}/{tagId}', 'Api\Manga\Controller\MangaController', 'addTagToManga');


// POST add a new manga
$app->addRoute(RequestMethod::POST, '/api/manga', 'Api\Manga\Controller\MangaController', 'addManga');


// PUT update a manga
$app->addRoute(RequestMethod::PUT, '/api/manga/{mangaId}', 'Api\Manga\Controller\MangaController', 'updateManga');


// DELETE remove a manga
$app->addRoute(RequestMethod::DELETE, '/api/manga/{mangaId}', 'Api\Manga\Controller\MangaController', 'removeManga');


// DELETE tag from  manga
$app->addRoute(RequestMethod::DELETE, '/api/manga/tags/{mangaId}/{tagId}', 'Api\Manga\Controller\MangaController', 'removeMangaTag');

