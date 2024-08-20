<?php

// use Core\RequestMethod;


// $baseMangaPath = "/api/manga";


// // GET search manga by name
// $app->addRoute(RequestMethod::GET, "$baseMangaPath/search/{searchTerm}", "Api\Manga\Controller\MangaController", "searchMangaByName");

// // GET related mangaka by manga ID
// $app->addRoute(RequestMethod::GET, "$baseMangaPath/mangaka/{id}", "Api\Manga\Controller\MangaController", "getRelatedMangaka");

// // GET all related tags for a manga by ID
// $app->addRoute(RequestMethod::GET, "$baseMangaPath/tags/{id}", "Api\Manga\Controller\MangaController", "getAllMangaRelatedTags");

// // GET check if manga is a user's favorite
// $app->addRoute(RequestMethod::GET, "$baseMangaPath/user/{id}/{userId}", "Api\Manga\Controller\MangaController", "checkIfIsUserFavorite")->middleware('auth');

// // POST add a new tag to a manga
// $app->addRoute(RequestMethod::POST, "$baseMangaPath/tags/{mangaId}/{tagId}", "Api\Manga\Controller\MangaController", "addTagToManga")->middleware('auth');


// // DELETE remove a tag from a manga
// $app->addRoute(RequestMethod::DELETE, "$baseMangaPath/tags/{mangaId}/{tagId}", "Api\Manga\Controller\MangaController", "removeMangaTag")->middleware('auth');

namespace Api\Manga;

use Core\Base\BaseApiEndpoint;

class MangaEndpoint extends BaseApiEndpoint
{
    public function __construct()
    {
        parent::__construct('/api/manga', 'Api\Manga\Controller\MangaController');
    }

    
    protected function registerRoutes()
    {
        parent::registerRoutes();
       
    }
}