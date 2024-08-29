<?php

namespace Auth\Controllers;


use Core\App;
use Core\Controllers\_BaseController;
use Auth\Services\AuthService;
use Core\HTTPRequest;
use Core\HTTPResponse;


class AuthController extends _BaseController
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = App::injectService()->getContainer(AuthService::class);
    }

    public function login(HTTPRequest $request, HTTPResponse $response, $params)
    {

        $body = $request->getBody();
        $email = $body['email'];
        $password = $body['password'];

        try {
            $autentification = $this->authService->authentication($email, $password);
            $this->sendSuccessResponse($response, $autentification);
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, 'login failed', 500);
        }
    }

    public function validate(HTTPRequest $request, HTTPResponse $response, $params)
    {

        $headers = $request->getHeaders();

        try {
            $tokenValidated = $this->authService->validateToken($headers);
            $this->sendSuccessResponse($response, $tokenValidated);
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, 'failed to validate authentification', 500);
        }
    }

    public function takeIdRoleInToken(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $headers = $request->getHeaders();

        try {
            $tokenValidatedWithOnlyIdRole = $this->authService->idRoleToken($headers);
            $this->sendSuccessResponse($response, $tokenValidatedWithOnlyIdRole);
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, 'Failed to get id_role in token validated', 500);
        }
    }
}