<?php

namespace EmailConfirm\Service;

use Core\App;
use EmailConfirm\Model\EmailConfirm;
use EmailConfirm\Repository\EmailConfirmRepository;

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
  {
    $emailConfirm = new EmailConfirm($data);
    $this->emailRepository->createEmailConfirm($emailConfirm);
  }

  public function deleteEmailConfirm(string $email)
  {
    return $this->emailRepository->deleteEmailConfirm($email);
  }
}
