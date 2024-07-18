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

    public function getUserMangas(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $userId = $params['userId'];
        $mangas = $this->mangaService->getMangaById($userId);
        if ($mangas === null) {
            $response->abort(404);
        } else {
            $response->sendJsonResponse($mangas);
        }
    }
    public function addManga(HTTPRequest $request, HTTPResponse $response)
    {
        $response->sendJsonResponse(['response' => 'hello from manga', 'status' => 200]);
    }
    public function updateManga(HTTPRequest $request, HTTPResponse $response)
    {
        $response->sendJsonResponse(['response' => 'hello from manga', 'status' => 200]);
    }
    public function removeManga(HTTPRequest $request, HTTPResponse $response)
    {
        $response->sendJsonResponse(['response' => 'hello from manga', 'status' => 200]);
    }
}
