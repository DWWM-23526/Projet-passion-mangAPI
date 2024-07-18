<?php


use Common\Core\RequestMethod;

//  GET all 
$app->addRoute(RequestMethod::GET, '/api/tags/mangas', 'TagsManga\Controller\TagsMangaController', 'getAll');

//  GET all manga tags
$app->addRoute(RequestMethod::GET, '/api/manga/{mangaId}/tags', 'TagsManga\Controller\TagsMangaController', 'getAllMangaTags');

//  GET all tag mangas
$app->addRoute(RequestMethod::GET, '/api/tag/{tagId}/mangas', 'TagsManga\Controller\TagsMangaController', 'getAllTagMangas');

// POST crete new tag_manga
$app->addRoute(RequestMethod::POST, '/api/tags/mangas', 'TagsManga\Controller\TagsMangaController', 'create');


// // DELETE remove a favorite
$app->addRoute(RequestMethod::DELETE, '/api/tag/{tagId}/manga/{mangaId}', 'TagsManga\Controller\TagsMangaController', 'delete');
