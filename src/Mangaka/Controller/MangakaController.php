<?php

namespace Mangaka\Controller;

use Common\Core\App;
use Common\Core\HTTPRequest;
use Common\core\HTTPResponse;
use Mangaka\Service\MangakaService;

class MangakaController
{

  private MangakaService $mangakaService;

  public function __construct()
  {
    $this->mangakaService = App::injectService()->getContainer(MangakaService::class);
  }

  public function index(HTTPRequest $request, HTTPResponse $response)
  {
    $response->sendJsonResponse(['response' => "Hello from mangaka", 'status' => 200]);
  }
}
