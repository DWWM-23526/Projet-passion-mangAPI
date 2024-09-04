<?php

namespace Auth\Repositories;

use Auth\Models\EmailConfirm;
use Core\repositories\_BaseApiRepository;

class EmailConfirmRepository extends _BaseApiRepository
{
  protected $table = 'email_confirmation';
  protected $modelClass = EmailConfirm::class;
  protected $primaryKey = "id_conf";

  private $column = "email";

  public function getEmailByEmail($email)
  {
    return $this->checkIfExists($this->table, [$email], ['email']);
  }

  public function getNameByName($name)
  {
    return $this->checkIfExists($this->table, [$name], ['name']);
  }

  public function deleteByEmail($email)
  {
    return $this->delete($email, $this->column);
  }
}
