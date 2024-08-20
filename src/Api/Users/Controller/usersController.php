<?php

namespace Api\Users\Controller;


use Api\Users\Service\UsersService;
use Core\Base\BaseApiController;
use Core\HTTPRequest;
use Core\HTTPResponse;


class UsersController extends BaseApiController
{
    public function __construct()
    {
        parent::__construct(UsersService::class);
    }

    public function getAllUserRelatedManga(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $userId = $params['id'];
        try {
            $manga = $this->service->getAllUserRelatedManga($userId);
        } catch (\Throwable $th) {
            $response->abort();
        }
        $response->sendJsonResponse($manga);
    }

    public function addMangaToUser(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $userId = $params['id'];
        $mangaId = $params['mangaId'];
        try {
            $this->service->addMangaToUser($userId, $mangaId);
        } catch (\Throwable $th) {
            $response->abort();
        }
        $response->sendJsonResponse(["manga id : $mangaId successfully added to user Id : $userId"]);
    }

    public function removeMangaFromUser(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $userId = $params['id'];
        $mangaId = $params['mangaId'];
        try {
            $this->service->removeMangaFromUser($userId, $mangaId);
        } catch (\Throwable $th) {
            $response->abort();
        }
        $response->sendJsonResponse(["manga id : $mangaId successfully removed to user Id : $userId"]);
    }

   
}
