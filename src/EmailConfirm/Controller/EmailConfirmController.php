<?php

namespace EmailConfirm\Controller;

use Common\Core\App;
use Common\Core\HTTPRequest;
use Common\core\HTTPResponse;
use EmailConfirm\Service\EmailConfirmService;

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
    $emailId = $params["emailId"];
    $emailConfirm = $this->emailConfirmService->getEmailByEmail($emailId);
    if ($emailConfirm === null) {
      $response->abort(404);
    } else {
      $response->sendJsonResponse($emailConfirm);
    }
  }

  public function addEmailConfirm(HTTPRequest $request, HTTPResponse $response)
  {
    $body = $request->getBody();
    try {
      $this->emailConfirmService->createEmailConfirm($body);
    } catch (\Throwable $th) {
      $response->abort();
    }
    $response->sendJsonResponse(['emailConfirm crée']);
  }

  public function deleteEmailConfirm(HTTPRequest $request, HTTPResponse $response)
  {
    $response->sendJsonResponse(['response' => 'hello from emailConfirm'], 200);
  }
}
