<?php

namespace TagsManga\Controller;

use Common\Core\App;
use Common\Core\HTTPRequest;
use Common\Core\HTTPResponse;
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
        
        $tagsMangas = $this->tagsMangaService->getAll();
        $response->sendJsonResponse($tagsMangas);
    }

    public function getAllMangaTags(HTTPRequest $request, HTTPResponse $response, $params)
    {
        
        $mangaId = $params['mangaId'];    
        $favorites = $this->tagsMangaService->getAllMangaTags($mangaId);

        if ($favorites === null) {
            $response->abort(404);
        } else {
            $response->sendJsonResponse($favorites);
        }
    }

    public function getAllTagMangas(HTTPRequest $request, HTTPResponse $response, $params)
    {
        
        $tagId = $params['tagId'];    
        $favorites = $this->tagsMangaService->getAllTagMangas($tagId);

        if ($favorites === null) {
            $response->abort(404);
        } else {
            $response->sendJsonResponse($favorites);
        }
    }

    public function create(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $body = $request->getBody();
        $response->sendJsonResponse(['response' => 'hello from tags_mangas', 'body' => $body]);
        
    }

    public function delete(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $response->sendJsonResponse(['response' => 'hello from tags_mangas', 'tagId' => $params['tagId'], 'mangaId' => $params['mangaId']] );
    }
}
