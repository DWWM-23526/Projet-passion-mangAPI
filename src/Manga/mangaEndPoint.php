<?php

use Common\Core\RequestMethod;

// GET all mangas
$app->addRoute(RequestMethod::GET, "/api/manga", "Manga\Controller\MangaController", "getAllMangas");

// GET manga by user ID
$app->addRoute(RequestMethod::GET, '/api/manga/{userId}', 'Manga\Controller\MangaController', 'getUserMangas');

// POST add a new manga

$app->addRoute(RequestMethod::POST, '/api/manga', 'Manga\Controller\MangaController', 'addManga');

// PUT update a manga

$app->addRoute(RequestMethod::PUT, '/api/manga/{userId}/{mangaId}', 'Manga\Controller\MangaController', 'updateManga');

// DELETE remove a manga
$app->addRoute(RequestMethod::DELETE, '/api/manga/{userId}/{mangaId}', 'Manga\Controller\MangaController', 'removeManga');
