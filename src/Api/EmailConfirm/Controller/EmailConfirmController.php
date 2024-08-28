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
      $this->sendSuccessResponse($response, $emailConfirm);
    } catch (\Throwable $th) {
      $this->sendErrorResponse($response,'Failed to fetch data', 404);
    }

  }

  public function addEmailConfirm(HTTPRequest $request, HTTPResponse $response)
  {
    $body = $request->getBody();
    try {
      $this->service->createEmailConfirm($body);
      $this->sendSuccessResponse($response, ["email {$body['email']} crée"] );
    } catch (\Throwable $th) {
      $this->sendErrorResponse($response,'Failed to create email', 500);
    }

  }

  public function sendEmailToConfirmAccount(HTTPRequest $request, HTTPResponse $response)
  {
    $body = $request->getBody();
    try {
      $newEmailConfirm = $this->service->createEmailConfirm($body);
      $this->sendSuccessResponse($response, $newEmailConfirm );
    } catch (\Throwable $th) {
      $this->sendErrorResponse($response,'Failed to send email', 500);
    }
  }

  public function decodeTokenAndCreateAccount(HTTPRequest $request, HTTPResponse $response, $params)
  {

    $token = $params['token'];

    try {
      $newUser = $this->service->decodeTokenAndCreateAccount($token);
      $this->sendSuccessResponse($response, $newUser );
    } catch (\Throwable $th) {
      $this->sendErrorResponse($response,'Failed to decode or createUser: ' .$th->getMessage(), 500);
    }
  }

  public function deleteEmailConfirm(HTTPRequest $request, HTTPResponse $response, $params)
  {
    $email = $params['email'];
    try {
      $this->service->deleteEmailConfirm($email);
      $this->sendSuccessResponse($response, ["email {$email} bien delete !"] );
    } catch (\Throwable $th) {
      $this->sendErrorResponse($response,'Failed to delete email Confirmation', 500);
    }
  }
}
