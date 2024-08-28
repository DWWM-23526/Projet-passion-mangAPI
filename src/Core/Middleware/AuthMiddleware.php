<?php

namespace Core\middlewares;

use Api\Users\Repository\UsersRepository;
use Core\App;
use Core\Base\BaseMiddleware;
use Core\HTTPRequest;
use core\HTTPResponse;
use Core\Handler\JwtHandler;

class AuthMiddleware extends BaseMiddleware
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
