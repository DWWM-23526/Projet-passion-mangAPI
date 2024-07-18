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

  public function index(HTTPRequest $request, HTTPResponse $response)
  {
    $response->sendJsonResponse(['response' => "Hello from EmailConfirm", "status" => 200]);
  }
}
