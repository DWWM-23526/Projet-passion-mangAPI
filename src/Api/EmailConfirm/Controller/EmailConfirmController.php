<?php

namespace Api\EmailConfirm\Controller;

use Core\App;
use Core\HTTPRequest;
use core\HTTPResponse;
use Api\EmailConfirm\Service\EmailConfirmService;
use Services\MailerService;

class EmailConfirmController
{
  private MailerService $mailerService;
  private EmailConfirmService $emailConfirmService;
  public function __construct()
  {
    $this->mailerService = App::injectService()->getContainer(MailerService::class);
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

  public function sendEmailToConfirmAccount(HTTPRequest $request, HTTPResponse $response)
  {
    $body = $request->getBody();
    //TODO: mettre tous ça dans le service
    // $email = $body['email'];
    // $response->sendJsonResponse($body);
    // if (empty($email)) {
    //   $response->sendJsonResponse(['message' => 'Email requis']);
    //   return;
    // }

    // try {
    //   $user = $this->emailConfirmService->getEmailByEmail($email);
    //   // $response->sendJsonResponse($user);
    //   if ($user['COUNT'] >= 1) {
    //     $response->sendJsonResponse(["message" => "L'adresse {$email} existe déjà."]);
    //     return;
    //   }

      $newUser = $this->emailConfirmService->createEmailConfirm($body);

      // $this->mailerService->sendConfirmationEmail($newUser);
      $response->sendJsonResponse(["message" => "Email de confirmation envoyé à }."]);
    // } catch (\Exception $e) {
    //   $response->sendJsonResponse(["error" => "Erreur lors de l'envoi de l'e-mail: " . $e->getMessage()]);
    // }
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
