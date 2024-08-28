<?php
namespace Api\Endpoints;

use Api\EndPoints\_BaseApiEndpoint;

class MangakaEndPoint extends _BaseApiEndpoint
{
  protected function getBasePath(): string
  {
    return '/api/mangaka';
  }

  protected function getController(): string
  {
    return 'Api\Controllers\MangakaController';
  }

  protected function registerRoutes()
  {
    parent::registerRoutes();

    $this->addGet('/search/{searchTerm}', 'searchMangakaByName');
    $this->addGet('/mangas/{mangakaId}', 'getAllRelatedManga');
  }
}