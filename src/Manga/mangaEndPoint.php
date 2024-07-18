<?php

use Common\Core\RequestMethod;

// GET all mangas
$app->addRoute(RequestMethod::GET, "/api/manga", "Manga\Controller\MangaController", "getAllMangas");

// GET manga by ID
$app->addRoute(RequestMethod::GET, '/api/manga/{mangaId}', 'Manga\Controller\MangaController', 'getMangaById');

// POST add a new manga

$app->addRoute(RequestMethod::POST, '/api/manga', 'Manga\Controller\MangaController', 'addManga');

// PUT update a manga

$app->addRoute(RequestMethod::PUT, '/api/manga/{mangaId}', 'Manga\Controller\MangaController', 'updateManga');

// DELETE remove a manga
$app->addRoute(RequestMethod::DELETE, '/api/manga/{mangaId}', 'Manga\Controller\MangaController', 'removeManga');
