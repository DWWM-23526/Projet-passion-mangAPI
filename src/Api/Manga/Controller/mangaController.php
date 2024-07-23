<?php

namespace Api\Manga\Controller;

use Core\App;
use Core\HTTPRequest;

use core\HTTPResponse;
use Api\Manga\Service\MangaService;

class MangaController
{

    private MangaService $mangaService;

    public function __construct()
    {
        $this->mangaService = App::injectService()->getContainer(MangaService::class);
    }

    public function getAllMangas(HTTPRequest $request, HTTPResponse $response)
    {
        $mangas = $this->mangaService->getAllMangas();
        $response->sendJsonResponse($mangas);
    }

    public function getMangaById(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['mangaId'];
        try {
            $mangas = $this->mangaService->getMangaById($mangaId);
        } catch (\Throwable $th) {
            $response->abort();
        }
        $response->sendJsonResponse($mangas);
    }

    public function getRelatedMangaka(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['mangaId'];
        try {
            $mangaka = $this->mangaService->getRelatedMangaka($mangaId);
        } catch (\Throwable $th) {
            $response->abort();
        }
        $response->sendJsonResponse($mangaka);
    }

    public function getAllMangaRelatedTags(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['mangaId'];
        try {
            $tags = $this->mangaService->getAllMangaRelatedTags($mangaId);
        } catch (\Throwable $th) {
            $response->abort();
        }
        $response->sendJsonResponse($tags);
    }

    public function checkIfIsUserFavorite(HTTPRequest $request, HTTPResponse $response, $params){
        $mangaId = $params['mangaId'];
        $userId = $params['userId'];
        try{
            $check = $this->mangaService->checkIfIsUserFavorite($userId, $mangaId);
        } catch(\Throwable $th){
            $response->abort("Heeeuuuu Problemes !");
        }
        $response->sendJsonResponse($check);
    }

    public function addTagToManga(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['mangaId'];
        $tagId = $params['tagId'];
        try {
            $this->mangaService->addTagToManga($mangaId, $tagId);
        } catch (\Throwable $th) {
            $response->abort();
        }
        $response->sendJsonResponse(["tag id : $tagId  succesfuly added to manga id : $mangaId "]);
    }

    public function removeMangaTag(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['mangaId'];
        $tagId = $params['tagId'];
        try {
            $this->mangaService->removeMangaTag($mangaId, $tagId);
        } catch (\Throwable $th) {
            $response->abort();
        }
        $response->sendJsonResponse(["tag id : $tagId  succesfuly removed from manga id : $mangaId "]);
    }

    public function addManga(HTTPRequest $request, HTTPResponse $response,  $params)
    {
        $body = $request->getBody();
        try {
            $this->mangaService->createManga($body);
        } catch (\Throwable $e) {
            $response->abort($e->getMessage());
        }
        $response->sendJsonResponse(["Manga {$body['manga_name']} bien crée !"]);
    }

    public function updateManga(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['mangaId'];
        $body = $request->getBody();
        try {
            $this->mangaService->updateManga($body, $mangaId);
        } catch (\Throwable $e) {
            $response->abort("");
        }
        $response->sendJsonResponse(["Manga {$mangaId} bien modifié !"]);
    }

    public function removeManga(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['mangaId'];
        try {
            $this->mangaService->deleteManga($mangaId);
        } catch (\Throwable $th) {
            $response->abort("");
        }
        $response->sendJsonResponse(["Manga {$mangaId} bien delete !"]);
    }
}
