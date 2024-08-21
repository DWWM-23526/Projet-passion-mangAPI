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
            $this->sendSuccessResponse($response, $manga);
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, "Failed to retrieve manga related to user ID $userId.", 404);
        }
    }

    public function addMangaToUser(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $userId = $params['id'];
        $mangaId = $params['mangaId'];
        try {
            $this->service->addMangaToUser($userId, $mangaId);
            $this->sendSuccessResponse($response, null, "Manga ID $mangaId successfully added to user ID $userId.");
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, "Failed to add manga ID $mangaId to user ID $userId.");
        }
    }

    public function removeMangaFromUser(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $userId = $params['id'];
        $mangaId = $params['mangaId'];
        try {
            $this->service->removeMangaFromUser($userId, $mangaId);
            $this->sendSuccessResponse($response, null, "Manga ID $mangaId successfully removed from user ID $userId.");
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, "Failed to remove manga ID $mangaId from user ID $userId.");
        }
    }
}
