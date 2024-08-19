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
            $response->sendJsonResponse($mangakas);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }

    public function getAllRelatedManga(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangakaId = $params['mangakaId'];
        try {
            $relatedMangas = $this->mangakaService->getAllRelatedManga($mangakaId);
            $response->sendJsonResponse($relatedMangas);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }

    public function searchMangakaByName(HTTPRequest $request, HTTPResponse $response, $params)
    {

        $searchTerm = $params['searchTerm'];

        try {
            $mangaka = $this->mangakaService->searchMangakaByName($searchTerm);
            $response->sendJsonResponse($mangaka);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }

    public function addMangaka(HTTPRequest $request, HTTPResponse $response)
    {
        $body = $request->getBody();
        try {
            $this->mangakaService->createMangakas($body);
            $response->sendJsonResponse(["Magaka {$body['first_name']}{$body['last_name']} créé"]);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }
    public function updateMangaka(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangakaId = $params['mangakaId'];

        $body = $request->getBody();
        try {
            $this->mangakaService->updateMangaka($body, $mangakaId);
            $response->sendJsonResponse(["Mangaka {$body['first_name']}{$body['last_name']} créé"]);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }
    public function removeMangaka(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangakaId = $params['mangakaId'];
        try {
            $this->mangakaService->deleteMangaka($mangakaId);
            $response->sendJsonResponse(["Mangaka {$mangakaId} deleted"]);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }
}
