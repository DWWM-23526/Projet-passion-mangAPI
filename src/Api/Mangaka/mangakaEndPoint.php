<?php
namespace Api\Mangaka;

use Core\Base\BaseApiEndpoint;

class MangakaEndPoint extends BaseApiEndpoint
{
  protected function getBasePath(): string
  {
    return '/api/mangaka';
  }

  protected function getController(): string
  {
    return 'Api\Mangaka\Controller\MangakaController';
  }

  protected function registerRoutes()
  {
    parent::registerRoutes();

    $this->addGet('/search/{searchTerm}', 'searchMangakaByName');
    $this->addGet('/manga/{mangakaId}', 'getAllRelatedManga');
  }
}