<?php

namespace Auth\Middlewares;

use Core\App;
use Core\middlewares\_BaseMiddleware;
use Core\HTTPRequest;
use core\HTTPResponse;
use Auth\Handlers\JwtHandler;
use Auth\Repositories\UsersRepository;

class AuthMiddleware extends _BaseMiddleware
{

    private UsersRepository $usersRepository;

    public function __construct()
    {

        $this->usersRepository = App::injectRepository()->getContainer(UsersRepository::class);
    }

    public function handle(HTTPRequest $request, HTTPResponse $response,)
    {

        $headers = $request->getHeaders();
        $headers = array_change_key_case($headers, CASE_LOWER);

        if (isset($headers['authorization'])) {


            $token = str_replace('Bearer ', '', $headers['authorization']);

            try {

                $decodedToken =  JwtHandler::validateToken($token);

                if (!$decodedToken || !isset($decodedToken['Id_user'])) {
                    $response->abort('user invalid.', 401);
                }

                $userById = $this->usersRepository->getItemById($decodedToken['Id_user']);

                if (!$userById) {
                    $response->abort('user invalid.', 401);
                }
            } catch (\Exception $th) {
                $response->abort('Invalid token.', 401);
            }
        } else {
            $response->abort('No token provided.', 401);
        }
    }
}
