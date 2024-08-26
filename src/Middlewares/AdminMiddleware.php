<?php

namespace middlewares;

use Api\Users\Repository\UsersRepository;
use Core\App;
use Core\Base\BaseMiddleware;
use Core\HTTPRequest;
use core\HTTPResponse;
use Services\JwtService;

class AdminMiddleware extends BaseMiddleware
{
  private JwtService $jwtService;
  private UsersRepository $usersRepository;

  public function __construct()
  {
    $this->jwtService = App::injectService()->getContainer(JwtService::class);
    $this->usersRepository = App::injectRepository()->getContainer(UsersRepository::class);
  }

  public function handle(HTTPRequest $request, HTTPResponse $response)
  {

    $headers = $request->getHeaders();
    $headers = array_change_key_case($headers, CASE_LOWER);

    if (isset($headers['authorization'])) {
      $token = str_replace('Bearer ', '', $headers['authorization']);

      try {
        $decodedToken = $this->jwtService->validateToken($token);

        if (!$decodedToken || !isset($decodedToken['role'])) {
          $response->abort('id_role of user invalid', 401);
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