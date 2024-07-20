<?php

namespace Api\Mangaka\Controller;

use Core\App;
use Core\HTTPRequest;
use core\HTTPResponse;
use Api\Mangaka\Service\MangakaService;

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
        try {
            $mangakas = $this->mangakaService->getMangakaById($mangakaId);
        } catch (\Throwable $th) {
            $response->abort();
        }
        $response->sendJsonResponse($mangakas);
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
        $response->sendJsonResponse(["Mangaka {$body['first_name']} créé"]);

    }
    public function updateMangaka(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangakaId = $params['mangakaId'];

        $body = $request->getBody();
        try{
            $this->mangakaService->updateMangaka($body, $mangakaId);
            $response->sendJsonResponse(["Mangaka {$body['first_name']}{$body['last_name']} créé"]);
        }catch(\Throwable $th){
            $response->abort();
        }
        $response->sendJsonResponse(["Mangaka {$body['first_name']} updated"]);
    }
    public function removeMangaka(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangakaId = $params['mangakaId'];
        try {
            $this->mangakaService->deleteMangaka($mangakaId);
        } catch (\Throwable $th) {
            $response->abort();
        }
        $response->sendJsonResponse(["Mangaka {$mangakaId} deleted"]);
    }
}
