<?php

namespace TagsManga\Controller;

use Core\App;
use Core\HTTPRequest;
use Core\HTTPResponse;
use TagsManga\Service\TagsMangaService;

class TagsMangaController
{
    private TagsMangaService $tagsMangaService;

    public function __construct()
    {

        $this->tagsMangaService = App::injectService()->getContainer(TagsMangaService::class);
    }

    public function getAll(HTTPRequest $request, HTTPResponse $response)
    {
        try {
            $tagsMangas = $this->tagsMangaService->getAll();
        } catch (\Throwable $th) {
            $response->abort();
        }

        $response->sendJsonResponse($tagsMangas);
    }

    public function getAllMangaTags(HTTPRequest $request, HTTPResponse $response, $params)
    {

        $mangaId = $params['mangaId'];

        try {
            $favorites = $this->tagsMangaService->getAllMangaTags($mangaId);
        } catch (\Throwable $th) {
            $response->abort(404);
        }

        if ($favorites === null) {
            $response->abort(404);
        } else {
            $response->sendJsonResponse($favorites);
        }
    }

    public function getAllTagMangas(HTTPRequest $request, HTTPResponse $response, $params)
    {

        $tagId = $params['tagId'];

        try {
            $favorites = $this->tagsMangaService->getAllTagMangas($tagId);
        } catch (\Throwable $e) {
            $response->abort(404);
        }

        if ($favorites === null) {
            $response->abort(404);
        } else {
            $response->sendJsonResponse($favorites);
        }
    }

    public function create(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $data = $request->getBody();

        try {
            $this->tagsMangaService->createTagManga($data);
        } catch (\Throwable $e) {
            $response->abort(404);
        }

        $response->setStatusCode(200);
    }

    public function delete(HTTPRequest $request, HTTPResponse $response, $params)
    {

        try {
            $this->tagsMangaService->deleteTagManga($params['tagId'], $params['mangaId']);
        } catch (\Throwable $th) {
            $response->abort();
        }

        $response->setStatusCode(200);
    }
}
