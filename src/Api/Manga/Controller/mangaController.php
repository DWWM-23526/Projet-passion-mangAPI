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
            $response->sendJsonResponse($mangas);
        } catch (\Throwable $th) {
            $response->abort();
        }
        
    }

    public function searchMangaByName(HTTPRequest $request, HTTPResponse $response, $params)
    {

        $searchTerm = $params['searchTerm'];

        try {
            $mangas = $this->mangaService->searchMangaByName($searchTerm); 
            $response->sendJsonResponse($mangas);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }

    public function getRelatedMangaka(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['mangaId'];
        try {
            $mangaka = $this->mangaService->getRelatedMangaka($mangaId);
            $response->sendJsonResponse($mangaka);
        } catch (\Throwable $th) {
            $response->abort();
        }
        
    }

    public function getAllMangaRelatedTags(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['mangaId'];
        try {
            $tags = $this->mangaService->getAllMangaRelatedTags($mangaId);
            $response->sendJsonResponse($tags);
        } catch (\Throwable $th) {
            $response->abort();
        }
        
    }

    public function checkIfIsUserFavorite(HTTPRequest $request, HTTPResponse $response, $params){
        $mangaId = $params['mangaId'];
        $userId = $params['userId'];
        try{
            $check = $this->mangaService->checkIfIsUserFavorite($userId, $mangaId);
            $response->sendJsonResponse($check);
        } catch(\Throwable $th){
            $response->abort("Heeeuuuu Problemes !");
        }
        
    }

    public function addTagToManga(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['mangaId'];
        $tagId = $params['tagId'];
        try {
            $this->mangaService->addTagToManga($mangaId, $tagId);
            $response->sendJsonResponse(["tag id : $tagId  succesfuly added to manga id : $mangaId "]);
        } catch (\Throwable $th) {
            $response->abort();
        }
        
    }

    public function removeMangaTag(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['mangaId'];
        $tagId = $params['tagId'];
        try {
            $this->mangaService->removeMangaTag($mangaId, $tagId);
            $response->sendJsonResponse(["tag id : $tagId  succesfuly removed from manga id : $mangaId "]);
        } catch (\Throwable $th) {
            $response->abort();
        }
        
    }

    public function addManga(HTTPRequest $request, HTTPResponse $response,  $params)
    {
        $body = $request->getBody();
        try {
            $this->mangaService->createManga($body);
            $response->sendJsonResponse(["Manga {$body['manga_name']} bien crée !"]);
        } catch (\Throwable $e) {
            $response->abort($e->getMessage());
        }
        
    }

    public function updateManga(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['mangaId'];
        $body = $request->getBody();
        try {
            $this->mangaService->updateManga($body, $mangaId);
            $response->sendJsonResponse(["Manga {$mangaId} bien modifié !"]);
        } catch (\Throwable $e) {
            $response->abort("");
        }
        
    }

    public function removeManga(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['mangaId'];

        try {
            $response->sendJsonResponse(["Manga {$mangaId} bien delete !"]);
            $this->mangaService->deleteManga($mangaId);
        } catch (\Throwable $th) {
            $response->abort("");
        }
        
    }
}
