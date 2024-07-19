<?php

namespace EmailConfirm\Repository;

use Core\App;
use Core\Database;
use EmailConfirm\Model\EmailConfirm;

class EmailConfirmRepository
{
  private string $table = 'email_confirmation';
  private mixed $db;

  public function __construct()
  {
    $this->db = App::inject()->getContainer(Database::class);
  }

  // CRUD

  public function getAllEmails()
  {
    $result = $this->db->query("SELECT * FROM $this->table")->fetchAllOrFail();
    return array_map(fn ($data) => new EmailConfirm($data), $result);
  }

  public function getEmailByEmail(string $email)
  {
    $result = $this->db->query("SELECT * FROM $this->table WHERE email = :email", ['email' => $email])->fetchOrFail();
    return $result ? new EmailConfirm($result) : null;
  }


  public function createEmailConfirm(EmailConfirm $emailConfirm)
  {
    $query = "INSERT INTO $this->table(
    id_conf,
    email,
    cle,
    date)
    VALUES (
    :id_conf,
    :email,
    :cle,
    :date
    )";

    $values = $emailConfirm->toArray();

    try {
      $this->db->query($query, $values);
    } catch (\PDOException $e) {
      throw new \Exception("Error on EmailConfirm" . $e->getMessage());
    }
  }

  public function deleteEmailConfirm(string $email)
  {
    try {
      $this->db->query("DELETE FROM $this->table WHERE email = :email", ["email" => $email]);
    } catch (\PDOException $e) {
      throw new \Exception("Erreur lors du delete du mail" . $e->getMessage());
    }
  }
}
