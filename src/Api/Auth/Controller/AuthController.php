<?php

namespace Api\Auth\Controller;

use Api\Auth\Service\AuthService;
use Core\App;
use Core\HTTPRequest;
use Core\HTTPResponse;


class AuthController
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = App::injectService()->getContainer(AuthService::class);
    }

    public function login(HTTPRequest $request, HTTPResponse $response, $params){

        $body = $request->getBody();

        $email = $body['email'];
        $password = $body['password'];

        try {
            $autentification = $this->authService->authentication($email, $password);
        } catch (\Throwable $th) {
            $response->abort();
        }
        $response->sendJsonResponse($autentification);

    }

    public function validate(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $body = $request->getBody();

        $headers = $request->getHeaders();
        

        try {
            $tokenValidated = $this->authService->validateToken($headers);
        } catch (\Throwable $th) {
            // $response->abort();
        }
        $response->sendJsonResponse($tokenValidated);


    }

   
}
