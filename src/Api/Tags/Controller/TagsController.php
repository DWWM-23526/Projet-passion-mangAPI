<?php

namespace Api\Tags\Controller;

use Core\App;
use Core\HTTPRequest;
use core\HTTPResponse;
use Api\Tags\Service\TagsService;

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
        try {
            $tag = $this->tagsService->getTagById($tagId);
        } catch (\Throwable $th) {
            $response->abort();
        }
        $response->sendJsonResponse($tag);
    }

    public function getAllTagsRelatedManga(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $tagId = $params['tagId'];
        try {
           $relatedTagsMangas = $this->tagsService->getAllTagsRelatedManga($tagId);
        } catch (\Throwable $th) {
            $response->abort();
        }
        $response->sendJsonResponse($relatedTagsMangas);
    }

    public function addTag(HTTPRequest $request, HTTPResponse $response){
        $body = $request->getBody();
        try {
            $this->tagsService->createTag($body);
        } catch (\Throwable $th) {
            $response->abort();
        }
        $response->sendJsonResponse(["Tag {$body['tag_name']} créé"]);
    }

    public function updateTag(HTTPRequest $request, HTTPResponse $response, $params){
        $tagId = $params["tagId"];
        $body = $request->getBody();
        try {
            $this->tagsService->updateTag($body, $tagId);
        } catch (\Throwable $th) {
            $response->abort();
        }
        $response->sendJsonResponse(["Tag {$tagId} updated"]);
    }

    public function deleteTag(HTTPRequest $request, HTTPResponse $response, $params){
        $tagId = $params['tagId'];
        try {
            $this->tagsService->deleteTag($tagId);
        } catch (\Throwable $th) {
            $response->abort();
        }
       $response->sendJsonResponse(["Tag {$tagId} bien delete"]);
    }
}