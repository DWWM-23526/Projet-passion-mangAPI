<?php

namespace Api\Mangaka\Controller;

use Core\Base\BaseApiController;
use Core\HTTPRequest;
use core\HTTPResponse;
use Api\Mangaka\Service\MangakaService;

class MangakaController extends BaseApiController
{
    public function __construct()
    {
        parent::__construct(MangakaService::class);
    }

    public function getAllMangakas(HTTPRequest $request, HTTPResponse $response)
    {
        $mangakas = $this->service->getAllMangakas();
        $response->sendJsonResponse($mangakas);
    }

    public function getMangakaById(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangakaId = $params['mangakaId'];
        try {
            $mangakas = $this->service->getMangakaById($mangakaId);
            $response->sendJsonResponse($mangakas);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }

    public function getAllRelatedManga(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangakaId = $params['mangakaId'];
        try {
            $relatedMangas = $this->service->getAllRelatedManga($mangakaId);
            $response->sendJsonResponse($relatedMangas);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }

    public function searchMangakaByName(HTTPRequest $request, HTTPResponse $response, $params)
    {

        $searchTerm = $params['searchTerm'];

        try {
            $mangaka = $this->service->searchMangakaByName($searchTerm);
            $response->sendJsonResponse($mangaka);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }

    public function addMangaka(HTTPRequest $request, HTTPResponse $response)
    {
        $body = $request->getBody();
        try {
            $this->service->createMangakas($body);
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
            $this->service->updateMangaka($body, $mangakaId);
            $response->sendJsonResponse(["Mangaka {$body['first_name']}{$body['last_name']} créé"]);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }
    public function removeMangaka(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangakaId = $params['mangakaId'];
        try {
            $this->service->deleteMangaka($mangakaId);
            $response->sendJsonResponse(["Mangaka {$mangakaId} deleted"]);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }
}
