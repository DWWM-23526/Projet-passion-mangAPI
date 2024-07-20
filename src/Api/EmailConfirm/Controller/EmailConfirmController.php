<?php

namespace Api\EmailConfirm\Controller;

use Core\App;
use Core\HTTPRequest;
use core\HTTPResponse;
use Api\EmailConfirm\Service\EmailConfirmService;

class EmailConfirmController
{
  private EmailConfirmService $emailConfirmService;
  public function __construct()
  {
    $this->emailConfirmService = App::injectService()->getContainer(EmailConfirmService::class);
  }

  public function getAllEmailConfirms(HTTPRequest $request, HTTPResponse $response)
  {
    $email = $this->emailConfirmService->getAllEmails();
    $response->sendJsonResponse($email);
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
