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

    public function addUser(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $body = $request->getBody();
        try {
            $this->usersService->createUser($body);
        } catch (\Throwable $th) {
            $response->abort();
        }

        $response->sendJsonResponse(["User {$body['name']} créé"]);
    }

    public function updateUser(HTTPRequest $request, HTTPResponse $response,  $params){

        $userId = $params['UserId'];
        $body = $request->getBody();
        try {
            $this->usersService->updateUser($body, $userId);
        } catch (\Throwable $th) {
            $response->abort();
        }
        $response->sendJsonResponse(["User {$body['name']} updated"]);
    }

    public function deleteUser(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $userId = $params['UserId'];
        try {
            $this->usersService->deleteUser($userId);
        } catch (\Throwable $th) {
            $response->abort();
        }
        $response->sendJsonResponse(["User with id: {$userId} deleted"]);
    }
}
