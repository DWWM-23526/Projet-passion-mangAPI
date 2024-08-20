<?php


namespace Api\Manga\Controller;


use Core\HTTPRequest;
use Core\HTTPResponse;
use Api\Manga\Service\MangaService;
use Core\Base\BaseApiController;

class MangaController extends BaseApiController
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
            $response->sendJsonResponse($mangas);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }

    public function getRelatedMangaka(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['id'];
        try {
            $mangaka = $this->service->getRelatedMangaka($mangaId);
            $response->sendJsonResponse($mangaka);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }

    public function getAllMangaRelatedTags(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['id'];
        try {
            $tags = $this->service->getAllMangaRelatedTags($mangaId);
            $response->sendJsonResponse($tags);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }

    public function checkIfIsUserFavorite(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['id'];
        $userId = $params['userId'];
        try {
            $check = $this->service->checkIfIsUserFavorite($userId, $mangaId);
            $response->sendJsonResponse($check);
        } catch (\Throwable $th) {
            $response->abort("Heeeuuuu Problemes !");
        }
    }

    public function addTagToManga(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['id'];
        $tagId = $params['tagId'];
        try {
            $this->service->addTagToManga($mangaId, $tagId);
            $response->sendJsonResponse(["tag id : $tagId  succesfuly added to manga id : $mangaId "]);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }

    public function removeMangaTag(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['id'];
        $tagId = $params['tagId'];
        try {
            $this->service->removeMangaTag($mangaId, $tagId);
            $response->sendJsonResponse(["tag id : $tagId  succesfuly removed from manga id : $mangaId "]);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }
}

