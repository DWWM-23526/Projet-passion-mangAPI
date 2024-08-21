<?php

namespace Api\EmailConfirm\Service;

use Core\App;
use Api\EmailConfirm\Repository\EmailConfirmRepository;
use Api\Users\Service\UsersService;
use Core\Base\BaseApiService;
use Services\JwtService;
use Services\MailerService;

class EmailConfirmService extends BaseApiService
{
  private JwtService $jwtService;
  private MailerService $mailerService;
  private UsersService $usersService;

  public function __construct()
  {
    parent::__construct(EmailConfirmRepository::class);
   
    $this->jwtService = App::injectService()->getContainer(JwtService::class);
    $this->mailerService = App::injectService()->getContainer(MailerService::class);
    $this->usersService = App::injectService()->getContainer(UsersService::class);
  }
  public function getEmailByEmail(string $email)
  {
    return $this->repository->getEmailByEmail($email);
  }

  public function getNameByName(string $name)
  {
    return $this->repository->getNameByName($name);
  }

  public function createEmailConfirm(array $data)
  {
    $email = $data['email'];
    $name = $data['name'];
    $password = $data['password'];

    $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);

    $data['password'] = $hashedPassword;

    $existingEmail = $this->repository->getEmailByEmail($email);

    if ($existingEmail[0]['result'] >= 1) {

      throw new \Exception("L'adresse email existe deja");
    }
    
    try {
      $token = $this->jwtService->generateEmailToken($data);

      $this->mailerService->sendConfirmationEmail($email, $token);

      $this->repository->createItem([
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
    $this->deleteColumnEmailConfirmWhenEmailValidated($tokenDestruct);
    return $this->createAccount($tokenDestruct);
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

  private function destructToken($token)
  {
    $keyToRemove = ['iss', 'iat', 'exp'];
    foreach ($keyToRemove as $key) {
      unset($token[$key]);
    }
    return $token;
  }

  private function deleteColumnEmailConfirmWhenEmailValidated($tokenDecode)
  {
    $tokenDecodeEmail = $tokenDecode['email'];
    try {
      $this->repository->deleteEmailConfirm($tokenDecodeEmail);
    } catch (\Throwable $th) {
      return $th;
    }
    return $tokenDecode;
  }

  private function createAccount($tokenDecode)
  {
    try {
      $this->usersService->create($tokenDecode);
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
    return $this->repository->deleteEmailConfirm($email);
  }
}
