<?php

namespace Mangaka\Controller;

use Common\Core\App;
use Common\Core\HTTPRequest;
use Mangaka\Service\MangakaService;

class MangakaController
{
  
  private MangakaService $mangakaService;

  public function __construct()
  {
    $this->mangakaService = App::injectService()->getContainer(MangakaService::class) ;
  }

  public function index(HTTPRequest $request)
  {
  }
}
