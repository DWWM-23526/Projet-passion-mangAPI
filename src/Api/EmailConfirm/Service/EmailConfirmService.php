<?php

namespace Api\EmailConfirm\Service;

use Core\App;
use Api\EmailConfirm\Model\EmailConfirm;
use Api\EmailConfirm\Repository\EmailConfirmRepository;
use Services\JwtService;
use Services\MailerService;

class EmailConfirmService
{
  private EmailConfirmRepository $emailRepository;
  private JwtService $jwtService;
  private MailerService $mailerService;

  public function __construct()
  {
    $this->jwtService = App::injectService()->getContainer(JwtService::class);
    $this->emailRepository = App::injectRepository()->getContainer(EmailConfirmRepository::class);
    $this->mailerService = App::injectService()->getContainer(MailerService::class);
  }
  public function getEmailByEmail(string $email)
  {
    return $this->emailRepository->getEmailByEmail($email);
  }

  public function createEmailConfirm(array $data)
  {
    $email = $data['email'];
    $existingUser = $this->emailRepository->getEmailByEmail($email);
    if ($existingUser[0]['result'] >= 1) {

      throw new \Exception("L'adresse email existe deja");
    }
    try {
    $token = $this->jwtService->generateEmailToken($data);
    
    $this->mailerService->sendConfirmationEmail($email, $token);

    $this->emailRepository->createEmailConfirm([
      'email' => $email,
      'token' => $token
    ]);
    return "Mail envoyé";
    } catch (\Throwable $th) {
      return $th;
    }
  }

  public function deleteEmailConfirm($email)
  {
    return $this->emailRepository->deleteEmailConfirm($email);
  }
}
