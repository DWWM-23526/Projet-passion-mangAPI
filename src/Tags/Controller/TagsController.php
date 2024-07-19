<?php

namespace Tags\Controller;

use Core\App;
use Core\HTTPRequest;
use core\HTTPResponse;
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
            $response->sendJsonResponse(["Tag {$body['tag_name']} créé"]);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }

    public function updateTag(HTTPRequest $request, HTTPResponse $response){
        $body = $request->getBody();
        try {
            $this->tagsService->updateTag($body);
            $response->sendJsonResponse(["Tag {$body['tag_name']} updated"]);
        } catch (\Throwable $th) {
            $response->abort($th->getMessage());
        }
    }

    public function deleteTag(HTTPRequest $request, HTTPResponse $response, $params){
        $tag = $params['tagId'];
        // TODO: Vérification des données
        $this->tagsService->deleteTag($tag);
        $tag === null ? $response->abort() : $response->sendJsonResponse($tag);
    }
}