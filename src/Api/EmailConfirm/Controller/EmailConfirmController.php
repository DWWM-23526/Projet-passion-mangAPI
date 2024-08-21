<?php

namespace Api\EmailConfirm\Controller;

use Core\Base\BaseApiController;
use Core\HTTPRequest;
use core\HTTPResponse;
use Api\EmailConfirm\Service\EmailConfirmService;

class EmailConfirmController extends BaseApiController
{
  public function __construct()
  {
    parent::__construct(EmailConfirmService::class);
  }

  public function getEmailByEmail(HTTPRequest $request, HTTPResponse $response, $params)
  {
    $email = $params["email"];
    try {
      $emailConfirm = $this->service->getEmailByEmail($email);
    } catch (\Throwable $th) {
      $response->abort();
    }
    $response->sendJsonResponse($emailConfirm);
  }

  public function addEmailConfirm(HTTPRequest $request, HTTPResponse $response)
  {
    $body = $request->getBody();
    try {
      $this->service->createEmailConfirm($body);
    } catch (\Throwable $th) {
      $response->abort();
    }
    $response->sendJsonResponse(["email {$body['email']} crée"]);
  }

  public function sendEmailToConfirmAccount(HTTPRequest $request, HTTPResponse $response)
  {
    $body = $request->getBody();
    try {
      $newEmailConfirm = $this->service->createEmailConfirm($body);
      $response->sendJsonResponse(['response' =>$newEmailConfirm]);
    } catch (\Throwable $th) {
      $response->abort($th);
    }
  }

  public function decodeTokenAndCreateAccount(HTTPRequest $request, HTTPResponse $response, $params)
  {

    $token = $params['token'];

    try {
      $newUser = $this->service->decodeTokenAndCreateAccount($token);
      $response->sendJsonResponse($newUser);
    } catch (\Throwable $th) {
      $response->abort($th);
    }
  }

  public function deleteEmailConfirm(HTTPRequest $request, HTTPResponse $response, $params)
  {
    $email = $params['email'];
    try {
      $this->service->deleteEmailConfirm($email);
    } catch (\Throwable $th) {
      $response->abort();
    }
    $response->sendJsonResponse(["email {$email} bien delete !"]);
  }
}
