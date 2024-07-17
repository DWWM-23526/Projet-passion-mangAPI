<?php

namespace Common\Database\Migrations;

use Common\Core\App;
use Common\Core\Database;

class BaseMigration
{

  protected $db;
  public function __construct()
  {
    $this->db = App::inject()->getContainer(Database::class);
  }
  public function upParent(string $query)
  {
    if ($this->db === null) {
      throw new \Exception("Database connection could not be established.");
    }

    try {
      $this->db->query($query);
    } catch (\Throwable $e) {
      throw new \Exception("Error Processing Request :" . $e->getMessage());
    }
  }

  public function downParent(string $query)
  {
    if ($this->db === null) {
      throw new \Exception("Database connection could not be established.");
    }
    try {
      $this->db->query($query);
    } catch (\Throwable $e) {
      throw new \Exception("Error Processing Request :" . $e->getMessage());
    }
  }
}
