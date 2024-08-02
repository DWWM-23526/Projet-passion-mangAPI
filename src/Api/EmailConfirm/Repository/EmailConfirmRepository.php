<?php

namespace Api\EmailConfirm\Repository;

use Api\EmailConfirm\Model\EmailConfirm;
use Core\ORM\BaseRepository;


class EmailConfirmRepository extends BaseRepository
{
  protected $table = 'email_confirmation';
  protected $modelClass = EmailConfirm::class;
  protected $primaryKey = "id_conf";

  // CRUD

  public function getEmailByEmail($email)
  {
    return $this->checkIfExists($this->table, [$email], ['email']);
  }

  public function getNameByName($name)
  {
    return $this->checkIfExists($this->table, [$name], ['name']);
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
