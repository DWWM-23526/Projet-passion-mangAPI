<?php

namespace Favorites\Controller;

use Common\Core\App;
use Common\Core\HTTPRequest;
use Common\Core\HTTPResponse;
use Favorites\Service\FavoritesService;

class FavoritesController
{
    private FavoritesService $favoritesService;

    public function __construct()
    {
        
        $this->favoritesService = App::injectService()->getContainer(FavoritesService::class);
    }

    public function getAllFavorites(HTTPRequest $request, HTTPResponse $response)
    {
        
        $favorites = $this->favoritesService->getAllFavorites();
        $response->sendJsonResponse($favorites);
    }

    public function getUserFavorites(HTTPRequest $request, HTTPResponse $response, $params)
    {
        
        $userId = $params['userId'];
        $favorites = $this->favoritesService->getAllUserFavorites($userId);

        if ($favorites === null) {
            $response->abort(404);
        } else {
            $response->sendJsonResponse($favorites);
        }
    }

    public function addFavorite(HTTPRequest $request, HTTPResponse $response)
    {
        $response->sendJsonResponse(['response' => 'hello from favorites', 'status' => 200]);
        
    }

    public function updateFavorite(HTTPRequest $request, HTTPResponse $response)
    {
        $response->sendJsonResponse(['response' => 'hello from favorites', 'status' => 200]);
       
    }

    public function removeFavorite(HTTPRequest $request, HTTPResponse $response)
    {
        $response->sendJsonResponse(['response' => 'hello from favorites', 'status' => 200]);
    }
}
