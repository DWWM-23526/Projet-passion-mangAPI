<?php

namespace Api\EmailConfirm\Repository;

use Api\EmailConfirm\Model\EmailConfirm;
use Core\App;
use Core\Database;
use Core\ORM\Repository;

class EmailConfirmRepository extends Repository
{
  protected $table = 'email_confirmation';

  protected $modelClass = EmailConfirm::class;

  protected $primaryKey = "id_conf";



  // CRUD

  public function getAllEmails()
  {
    return $this->getAll();
  }

  public function getEmailByEmail($email)
  {
    return $this->getBy($email, "email");
  }


  public function createEmailConfirm($data)
  {
    return $this->create($data);
  }

  public function deleteEmailConfirm($id)
  {
    return $this->delete($id, "email");
  }
}
