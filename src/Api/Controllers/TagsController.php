<?php

namespace Api\Controllers;

use Core\Controllers\_BaseApiController;
use Api\Services\TagsService;
use Core\HTTPRequest;
use core\HTTPResponse;



class TagsController extends _BaseApiController
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
            $this->sendSuccessResponse($response, $relatedTagsMangas);
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, "Failed to retrieve mangas related to tag ID $tagId.", 404);
        }
    }
}