<?php

namespace Api\EmailConfirm\Controller;

use Core\App;
use Core\HTTPRequest;
use core\HTTPResponse;
use Api\EmailConfirm\Service\EmailConfirmService;
use Services\MailerService;

class EmailConfirmController
{
  private EmailConfirmService $emailConfirmService;
  public function __construct()
  {
    $this->emailConfirmService = App::injectService()->getContainer(EmailConfirmService::class);
  }

  public function getEmailByEmail(HTTPRequest $request, HTTPResponse $response, $params)
  {
    $email = $params["email"];
    try {
      $emailConfirm = $this->emailConfirmService->getEmailByEmail($email);
    } catch (\Throwable $th) {
      $response->abort();
    }
    $response->sendJsonResponse($emailConfirm);
  }

  public function addEmailConfirm(HTTPRequest $request, HTTPResponse $response)
  {
    $body = $request->getBody();
    try {
      $this->emailConfirmService->createEmailConfirm($body);
    } catch (\Throwable $th) {
      $response->abort();
    }
    $response->sendJsonResponse(["email {$body['email']} crée"]);
  }

  public function sendEmailToConfirmAccount(HTTPRequest $request, HTTPResponse $response)
  {
    $body = $request->getBody();
    try {
      $newEmailConfirm = $this->emailConfirmService->createEmailConfirm($body);
      $response->sendJsonResponse($newEmailConfirm);
    } catch (\Throwable $th) {
      $response->abort($th);
    }
  }

  public function decodeTokenAndCreateAccount(HTTPRequest $request, HTTPResponse $response, $params)
  {

    $token = $params['token'];

    try {
      $newUser = $this->emailConfirmService->decodeTokenAndCreateAccount($token);
      $response->sendJsonResponse($newUser);
    } catch (\Throwable $th) {
      $response->abort($th);
    }
  }

  public function deleteEmailConfirm(HTTPRequest $request, HTTPResponse $response, $params)
  {
    $email = $params['email'];
    try {
      $this->emailConfirmService->deleteEmailConfirm($email);
    } catch (\Throwable $th) {
      $response->abort();
    }
    $response->sendJsonResponse(["email {$email} bien delete !"]);
  }
}
