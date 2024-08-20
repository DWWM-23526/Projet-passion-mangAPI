<?php

namespace Api\Tags\Controller;


use Core\HTTPRequest;
use core\HTTPResponse;
use Api\Tags\Service\TagsService;
use Core\Base\BaseApiController;

class TagsController extends BaseApiController
{

    public function __construct()
    {
        parent::__construct(TagsService::class);
    }

    public function getAllTagsRelatedManga(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $tagId = $params['id'];
        try {
           $relatedTagsMangas = $this->service->getAllTagsRelatedManga($tagId);
        } catch (\Throwable $th) {
            $response->abort();
        }
        $response->sendJsonResponse($relatedTagsMangas);
    }
}