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

    public function getAllRelatedManga(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangakaId = $params['mangakaId'];
        try {
            $relatedMangas = $this->service->getAllRelatedManga($mangakaId);
            $this->sendSuccessResponse($response, $relatedMangas);
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, "Failed to retrieve related mangas for Mangaka ID $mangakaId.", 404);
        }
    }

    public function searchMangakaByName(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $searchTerm = $params['searchTerm'];
        try {
            $mangaka = $this->service->searchMangakaByName($searchTerm);
            $this->sendSuccessResponse($response, $mangaka);
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, "Failed to find Mangaka with name matching '$searchTerm'.", 404);
        }
    }

    
}
