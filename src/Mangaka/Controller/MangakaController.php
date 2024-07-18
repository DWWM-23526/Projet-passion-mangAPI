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

  public function getAllMangakas(HTTPRequest $request, HTTPResponse $response)
    {
        $mangakas = $this->mangakaService->getAllMangakas();
        $response->sendJsonResponse($mangakas);
    }

    public function getMangakaById(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangakaId = $params['mangakaId'];
        $mangakas = $this->mangakaService->getMangakaById($mangakaId);
        if ($mangakas === null) {
            $response->abort(404);
        } else {
            $response->sendJsonResponse($mangakas);
        }
    }
    public function addMangaka(HTTPRequest $request, HTTPResponse $response)
    {
        $response->sendJsonResponse(['response' => 'hello from manga'], 200);
    }
    public function updateMangaka(HTTPRequest $request, HTTPResponse $response)
    {
        $response->sendJsonResponse(['response' => 'hello from manga'], 200);
    }
    public function removeMangaka(HTTPRequest $request, HTTPResponse $response)
    {
        $response->sendJsonResponse(['response' => 'hello from manga'], 200);
    }
}
