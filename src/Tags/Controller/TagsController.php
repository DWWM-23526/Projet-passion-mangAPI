<?php

namespace Tags\Controller;

use Common\Core\App;
use Common\Core\HTTPRequest;
use Common\core\HTTPResponse;
use Tags\Service\TagsService;

class TagsController
{
    private TagsService $tagsService;

    public function __construct(){
        $this->tagsService = App::injectService()->getContainer(TagsService::class);
    }

    public function getAllTags(HTTPRequest $request, HTTPResponse $response){
        $tags = $this->tagsService->getAllTags();
        $response->sendJsonResponse($tags);
    }

    public function getTagById(HTTPRequest $request, HTTPResponse $response, $params){
        $tagId = $params['tagId'];
        $tag = $this->tagsService->getTagById($tagId);
        $tag === null ? $response->abort() : $response->sendJsonResponse($tag);
    }

    public function addTag(HTTPRequest $request, HTTPResponse $response){
        $body = $request->getBody();
        try {
            $this->tagsService->createTag($body);
            $response->sendJsonResponse(["Manga {$body['name']} créé"]);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }

    public function updateTag(HTTPRequest $request, HTTPResponse $response){
        $body = $request->getBody();
        try {
            $this->tagsService->updateTag($body);
            $response->sendJsonResponse(["Manga {$body['name']} créé"]);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }

    public function deleteTag(HTTPRequest $request, HTTPResponse $response){
        $tag = null;
        // TODO: Vérification des données
        // $tag = $this->tagsService->deleteTag();
        $tag === null ? $response->abort() : $response->sendJsonResponse($tag);
    }
}