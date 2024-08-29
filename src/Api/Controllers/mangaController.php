<?php
namespace Api\Controllers;

use Core\Controllers\_BaseApiController;
use Api\Services\MangaService;
use Core\HTTPRequest;
use Core\HTTPResponse;


class MangaController extends _BaseApiController
{
    public function __construct()
    {
        parent::__construct(MangaService::class);
    }

    public function searchMangaByName(HTTPRequest $request, HTTPResponse $response, $params)
    {

        $searchTerm = $params['searchTerm'];

        try {
            $mangas = $this->service->searchMangaByName($searchTerm);
            $this->sendSuccessResponse($response, $mangas);
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, 'Failed to fetch data', 404);
        }
    }

    public function getRelatedMangaka(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['id'];
        try {
            $mangaka = $this->service->getRelatedMangaka($mangaId);
            $this->sendSuccessResponse($response, $mangaka);
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, 'Failed to fetch data', 404);
        }
    }

    public function getAllMangaRelatedTags(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['id'];
        try {
            $tags = $this->service->getAllMangaRelatedTags($mangaId);
            $this->sendSuccessResponse($response, $tags);
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, 'Failed to fetch data', 404);
        }
    }

    public function checkIfIsUserFavorite(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['id'];
        $userId = $params['userId'];
        try {
            $check = $this->service->checkIfIsUserFavorite($userId, $mangaId);
            $this->sendSuccessResponse($response, $check);
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, 'Failed to fetch data', 404);
        }
    }

    public function addTagToManga(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['id'];
        $tagId = $params['tagId'];
        try {
            $data = $this->service->addTagToManga($mangaId, $tagId);
            $this->sendSuccessResponse($response, $data);
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, 'Failed to add tag relation', 500);
        }
    }

    public function removeMangaTag(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['id'];
        $tagId = $params['tagId'];
        try {
            $this->service->removeMangaTag($mangaId, $tagId);
            $this->sendSuccessResponse($response, ["tag id : $tagId  succesfuly added to manga id : $mangaId "]);
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, 'Failed to delete tag relation', 500);
        }
    }
}
