<?php

use Core\RequestMethod;


$baseMangaPath = "/api/manga";

// GET all mangas
$app->addRoute(RequestMethod::GET, $baseMangaPath, "Api\Manga\Controller\MangaController", "getAll");

// GET manga by ID
$app->addRoute(RequestMethod::GET, "$baseMangaPath/{id}", "Api\Manga\Controller\MangaController", "getById");

// GET search manga by name
$app->addRoute(RequestMethod::GET, "$baseMangaPath/search/{searchTerm}", "Api\Manga\Controller\MangaController", "searchMangaByName");

// GET related mangaka by manga ID
$app->addRoute(RequestMethod::GET, "$baseMangaPath/mangaka/{id}", "Api\Manga\Controller\MangaController", "getRelatedMangaka");

// GET all related tags for a manga by ID
$app->addRoute(RequestMethod::GET, "$baseMangaPath/tags/{id}", "Api\Manga\Controller\MangaController", "getAllMangaRelatedTags");

// GET check if manga is a user's favorite
$app->addRoute(RequestMethod::GET, "$baseMangaPath/user/{id}/{userId}", "Api\Manga\Controller\MangaController", "checkIfIsUserFavorite")->middleware('auth');

// POST add a new manga
$app->addRoute(RequestMethod::POST, $baseMangaPath, "Api\Manga\Controller\MangaController", "create")->middleware('auth');

// POST add a new tag to a manga
$app->addRoute(RequestMethod::POST, "$baseMangaPath/tags/{mangaId}/{tagId}", "Api\Manga\Controller\MangaController", "addTagToManga")->middleware('auth');

// PUT update a manga
$app->addRoute(RequestMethod::PUT, "$baseMangaPath/{id}", "Api\Manga\Controller\MangaController", "update")->middleware('auth');

// DELETE remove a manga
$app->addRoute(RequestMethod::DELETE, "$baseMangaPath/{id}", "Api\Manga\Controller\MangaController", "delete")->middleware('auth');

// DELETE remove a tag from a manga
$app->addRoute(RequestMethod::DELETE, "$baseMangaPath/tags/{mangaId}/{tagId}", "Api\Manga\Controller\MangaController", "removeMangaTag")->middleware('auth');

