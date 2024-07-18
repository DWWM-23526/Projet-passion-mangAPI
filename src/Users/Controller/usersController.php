<?php

namespace Users\Controller;

use Common\Core\App;
use Common\Core\HTTPRequest;
use Common\core\HTTPResponse;
use Users\Service\UsersService;

class UsersController
{
    private UsersService $usersService;

    public function __construct(){
        $this->usersService = App::injectService()->getContainer(UsersService::class);
    }

    public function getAllUsers(HTTPRequest $request, HTTPResponse $response){
        $users = $this->usersService->getAllUsers();
        $response->sendJsonResponse($users);
    }

    public function getUserById(HTTPRequest $request, HTTPResponse $response, $params){
        $userId = $params['userId'];
        $user = $this->usersService->getUserById($userId);
        $user === null ? $response->abort() : $response->sendJsonResponse($user);
    }

    public function addUser(HTTPRequest $request, HTTPResponse $response){
        $body = $request->getBody();
        try {
            $this->usersService->createUser($body);
            $response->sendJsonResponse(["User {$body['pseudo']} créé"]);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }

    public function updateUser(HTTPRequest $request, HTTPResponse $response){
        $body = $request->getBody();
        try {
            $this->usersService->updateUsers($body);
            $response->sendJsonResponse(["User {$body['pseudo']} updated"]);
        } catch (\Throwable $th) {
            $response->abort();
        }
    }

    public function deleteUser(HTTPRequest $request, HTTPResponse $response){
        $user = null;
        // TODO: Vérification des données à supprimer
        // $tag = $this->usersService->deleteUser($tag);
        $user === null ? $response->abort() : $response->sendJsonResponse($user);
    }
}