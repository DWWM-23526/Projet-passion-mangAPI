<?php

namespace Api\Users\Controller;

use Api\Users\Service\UsersService;
use Core\App;
use Core\HTTPRequest;
use core\HTTPResponse;


class UsersController
{
    private UsersService $usersService;

    public function __construct()
    {
        $this->usersService = App::injectService()->getContainer(UsersService::class);
    }

    public function getAllUsers(HTTPRequest $request, HTTPResponse $response)
    {
        $users = $this->usersService->getAllUsers();
        $response->sendJsonResponse($users);
    }

    public function getUserById(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $userId = $params['UserId'];

        try {
            $user = $this->usersService->getUserById($userId);
        } catch (\Throwable $th) {
            $response->abort();
        }
        $response->sendJsonResponse($user);
    }

    public function addUser(HTTPRequest $request, HTTPResponse $response)
    {
        $body = $request->getBody();
        try {
            $this->usersService->createUser($body);
        } catch (\Throwable $th) {
            $response->abort();
        }

        $response->sendJsonResponse(["User {$body['name']} créé"]);
    }

    // public function updateUser(HTTPRequest $request, HTTPResponse $response){
    //     $body = $request->getBody();
    //     try {
    //         $this->usersService->updateUsers($body);
    //         $response->sendJsonResponse(["User {$body['pseudo']} updated"]);
    //     } catch (\Throwable $th) {
    //         $response->abort();
    //     }
    // }

    // public function deleteUser(HTTPRequest $request, HTTPResponse $response, $params){
    //     $user = $params['UserId'];
    //     // TODO: Vérification des données à supprimer
    //     $this->usersService->deleteUser($user);
    //     $user === null ? $response->abort() : $response->sendJsonResponse($user);
    // }
}
