<?php

namespace Mangaka\Controller;

use Common\Core\HTTPRequest;
use Mangaka\Service\MangakaService;

class MangakaController
{
  private HTTPRequest $request;
  private MangakaService $mangakaService;

  public function __construct()
  {
    $this->mangakaService = new MangakaService();
  }

  public function index(HTTPRequest $request)
  {
  }
}
