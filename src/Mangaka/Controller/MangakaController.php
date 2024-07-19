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
        $mangakas === null ? $response->abort(404) : $response->sendJsonResponse($mangakas);
    }
    public function addMangaka(HTTPRequest $request, HTTPResponse $response)
    {
        $body = $request->getBody();
        try{
            $this->mangakaService->createMangakas($body);
            $response->sendJsonResponse(["Magaka {$body['first_name']}{$body['last_name']} créé"]);
        }catch(\Throwable $th){
            $response->abort();
        }
    }
    public function updateMangaka(HTTPRequest $request, HTTPResponse $response)
    {
        $body = $request->getBody();
        try{
            $this->mangakaService->createMangakas($body);
            $response->sendJsonResponse(["Magaka {$body['first_name']}{$body['last_name']} créé"]);
        }catch(\Throwable $th){
            $response->abort();
        }
    }
    public function removeMangaka(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaka = $params['mangakaId'];
        $this->mangakaService->deleteMangaka($mangaka);
        $mangaka === null ? $response->abort() : $response->sendJsonResponse([$mangaka]);
    }
}
