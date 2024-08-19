<?php

namespace Api\EmailConfirm\Service;

use Core\App;
use Api\EmailConfirm\Model\EmailConfirm;
use Api\EmailConfirm\Repository\EmailConfirmRepository;
use Api\Users\Service\UsersService;
use Services\JwtService;
use Services\MailerService;

class EmailConfirmService
{
  private EmailConfirmRepository $emailRepository;
  private JwtService $jwtService;
  private MailerService $mailerService;
  private UsersService $usersService;

  public function __construct()
  {
    $this->jwtService = App::injectService()->getContainer(JwtService::class);
    $this->emailRepository = App::injectRepository()->getContainer(EmailConfirmRepository::class);
    $this->mailerService = App::injectService()->getContainer(MailerService::class);
    $this->usersService = App::injectService()->getContainer(UsersService::class);
  }
  public function getEmailByEmail(string $email)
  {
    return $this->emailRepository->getEmailByEmail($email);
  }

  public function getNameByName(string $name)
  {
    return $this->emailRepository->getNameByName($name);
  }

  public function createEmailConfirm(array $data)
  {
    $email = $data['email'];
    $name = $data['name'];
    $password = $data['password'];

    $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);

    $data['password'] = $hashedPassword;

    $existingEmail = $this->emailRepository->getEmailByEmail($email);

    if ($existingEmail[0]['result'] >= 1) {

      throw new \Exception("L'adresse email existe deja");
    }
    
    try {
      $token = $this->jwtService->generateEmailToken($data);

      $this->mailerService->sendConfirmationEmail($email, $token);

      $this->emailRepository->createEmailConfirm([
        'email' => $email,
        'name' => $name
      ]);

      return "Mail envoyé";
    } catch (\Throwable $th) {
      return $th;
    }
  }

  public function decodeTokenAndCreateAccount($token)
  {
    $tokenDecode = $this->decodeToken($token);
    $this->compareInBDD($tokenDecode);
    $tokenDestruct = $this->destructToken($tokenDecode);
    
    return $this->createAccount($tokenDestruct);
  }

  private function destructToken($token)
  {
    $keyToRemove = ['iss', 'iat', 'exp'];
    foreach ($keyToRemove as $key) {
      unset($token[$key]);
    }
    return $token;
  }

  private function compareInBDD($tokenDecode)
  {
    $tokenDecodeName = $tokenDecode['name'];
    $tokenDecodeEmail = $tokenDecode['email'];
    $isExistingEmail = $this->getEmailByEmail($tokenDecodeEmail);
    $isExistingName = $this->getNameByName($tokenDecodeName);
    if ($isExistingEmail[0]['result'] == 0) {
      throw new \Exception("Email n'existe pas !");
    }
    if (($isExistingEmail[0]['result'] == 1) && ($isExistingName[0]['result'] == 1)) {
      return $tokenDecode;
    }
  }

  private function createAccount($tokenDecode)
  {
    try {
      $this->usersService->createUser($tokenDecode);
    } catch (\Throwable $th) {
      return "Erreur emailConfirmService : $th";
    }
  }

  private function decodeToken($token)
  {
    try {
      $token = $this->jwtService->validateToken($token);
    } catch (\Throwable $th) {
      return "Erreur emailConfirmService : $th";
    }
    return $token;
  }

  public function deleteEmailConfirm($email)
  {
    return $this->emailRepository->deleteEmailConfirm($email);
  }
}
