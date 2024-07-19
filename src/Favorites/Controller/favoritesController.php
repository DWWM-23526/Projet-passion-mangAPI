<?php

namespace Favorites\Controller;

use Core\App;
use Core\HTTPRequest;
use Core\HTTPResponse;
use Favorites\Service\FavoritesService;

class FavoritesController
{
    private FavoritesService $favoritesService;

    public function __construct()
    {

        $this->favoritesService = App::injectService()->getContainer(FavoritesService::class);
    }

    public function getAll(HTTPRequest $request, HTTPResponse $response)
    {
        try {
            $favorites = $this->favoritesService->getAllFavorites();
        } catch (\Throwable $th) {
            $response->abort(404);
        }

        $response->sendJsonResponse($favorites);
    }

    public function getUserFavorites(HTTPRequest $request, HTTPResponse $response, $params)
    {

        $userId = $params['userId'];

        try {
            $favorites = $this->favoritesService->getAllUserFavorites($userId);
        } catch (\Throwable $th) {
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
            $this->favoritesService->addFavorite($data);
        } catch (\Throwable $th) {
            $response->abort(404);
        }

        $response->setStatusCode(200);
    }

    public function delete(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $userId = $params['userId'];
        $mangaId = $params['mangaId'];

        try {
            $this->favoritesService->deleteFavorite($userId, $mangaId);
        } catch (\Throwable $th) {
            $response->abort(404);
        }
        $response->setStatusCode(200);
    }
}
