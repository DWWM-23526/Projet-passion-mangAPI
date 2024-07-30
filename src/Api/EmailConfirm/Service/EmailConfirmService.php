<?php

namespace Api\EmailConfirm\Service;

use Core\App;
use Api\EmailConfirm\Model\EmailConfirm;
use Api\EmailConfirm\Repository\EmailConfirmRepository;

class EmailConfirmService
{
  private EmailConfirmRepository $emailRepository;

  public function __construct()
  {
    $this->emailRepository = App::injectRepository()->getContainer(EmailConfirmRepository::class);
  }

  public function getAllEmails()
  {
    return $this->emailRepository->getAllEmails();
  }

  public function getEmailByEmail(string $email)
  {
    return $this->emailRepository->getEmailByEmail($email);
  }

  public function createEmailConfirm(array $data)
  { // Import jwt service & crée token 
    // Entre dans la bdd l'email 
    $this->emailRepository->createEmailConfirm($data);
  }

  public function deleteEmailConfirm($email)
  {
    return $this->emailRepository->deleteEmailConfirm($email);
  }
}
