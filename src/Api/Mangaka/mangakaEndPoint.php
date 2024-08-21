<?php
namespace Api\Mangaka;
use Core\Base\BaseApiEndpoint;

// GET all mangakas

// use Core\RequestMethod;

// $app->addRoute(RequestMethod::GET, "/api/mangaka", "Api\Mangaka\Controller\MangakaController", "getAllMangakas");

// // GET mangaka by Id
// $app->addRoute(RequestMethod::GET, '/api/mangaka/{mangakaId}', 'Api\Mangaka\Controller\MangakaController', 'getMangakaById');

// // GET search mangaka by name
// $app->addRoute(RequestMethod::GET, '/api/mangaka/search/{searchTerm}', 'Api\Mangaka\Controller\MangakaController', 'searchMangakaByName');


// // GET related mangas by mangaka Id
// $app->addRoute(RequestMethod::GET, '/api/mangas/mangaka/{mangakaId}', 'Api\Mangaka\Controller\MangakaController', 'getAllRelatedManga');

// // POST add a new manga

// $app->addRoute(RequestMethod::POST, '/api/mangaka', 'Api\Mangaka\Controller\MangakaController', 'addMangaka')->middleware('auth');

// // PUT update a manga

// $app->addRoute(RequestMethod::PUT, '/api/mangaka/{mangakaId}', 'Api\Mangaka\Controller\MangakaController', 'updateMangaka')->middleware('auth');

// // DELETE remove a manga
// $app->addRoute(RequestMethod::DELETE, '/api/mangaka/{mangakaId}', 'Api\Mangaka\Controller\MangakaController', 'removeMangaka')->middleware('auth');
class MangakaEndPoint extends BaseApiEndpoint
{
  public function __construct()
  {
    parent::__construct('/api/mangaka', 'Api\Mangaka\Controller\MangakaController');
  }

  protected function registerRoutes()
  {
    parent::registerRoutes();

    $this->addGet('/search/{searchTerm}', 'searchMangakaByName');
    $this->addGet('/manga/{mangakaId}', 'getAllRelatedManga');
  }
}