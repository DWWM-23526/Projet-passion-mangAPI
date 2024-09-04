<?php

namespace Api\Controllers;

use Core\Controllers\_BaseApiController;
use Api\Services\MangakaService;
use Core\HTTPRequest;
use core\HTTPResponse;


class MangakaController extends _BaseApiController
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
