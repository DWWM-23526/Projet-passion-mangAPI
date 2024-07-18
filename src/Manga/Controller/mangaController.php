<?php

namespace Manga\Controller;

use Common\Core\App;
use Common\Core\HTTPRequest;

use Common\core\HTTPResponse;
use Manga\Service\MangaService;

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
        $mangas = $this->mangaService->getMangaById($mangaId);
        if ($mangas === null) {
            $response->abort(404);
        } else {
            $response->sendJsonResponse($mangas);
        }
    }

    public function addManga(HTTPRequest $request, HTTPResponse $response)
    {
        $body = $request->getBody();
        try {
            $this->mangaService->createManga($body);
        } catch (\Throwable $e) {
            $response->abort();
        }
        $response->sendJsonResponse(["Manga bien crée !"]);
    }

    public function updateManga(HTTPRequest $request, HTTPResponse $response)
    {
        $body = $request->getBody();
        try {
            $this->mangaService->updateManga($body);
        } catch (\Throwable $e) {
            $response->abort();
        }
        $response->sendJsonResponse(["Manga bien modifié !"]);
    }

    public function removeManga(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $mangaId = $params['mangasId'];
        try {
            $this->mangaService->deleteManga($mangaId);
        } catch (\Throwable $th) {
            $response->abort();
        }
        $response->sendJsonResponse(["Manga bien delete !"]);
    }
}
