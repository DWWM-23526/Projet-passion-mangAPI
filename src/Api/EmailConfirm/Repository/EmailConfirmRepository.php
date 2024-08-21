<?php

namespace Api\EmailConfirm\Repository;

use Api\EmailConfirm\Model\EmailConfirm;
use Core\Base\BaseApiRepository;

class EmailConfirmRepository extends BaseApiRepository
{
  protected $table = 'email_confirmation';
  protected $modelClass = EmailConfirm::class;
  protected $primaryKey = "id_conf";

  public function getEmailByEmail($email)
  {
    return $this->checkIfExists($this->table, [$email], ['email']);
  }

  public function getNameByName($name)
  {
    return $this->checkIfExists($this->table, [$name], ['name']);
  }
}
