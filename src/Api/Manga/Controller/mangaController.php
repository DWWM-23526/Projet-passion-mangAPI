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

    public function addManga(HTTPRequest $request, HTTPResponse $response)
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
        $mangaId = $params['mangasId'];
        $body = $request->getBody();
        try {
            $this->mangaService->updateManga($body, $params);
        } catch (\Throwable $e) {
            $response->abort("");
        }
        $response->sendJsonResponse(["Manga {$body['manga_name']} bien modifié !"]);
    }

    public function removeManga(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['mangasId'];
        try {
            $this->mangaService->deleteManga($mangaId);
        } catch (\Throwable $th) {
            $response->abort("");
        }
        $response->sendJsonResponse(["Manga {$mangaId['Id_manga']} bien delete !"]);
    }
}
