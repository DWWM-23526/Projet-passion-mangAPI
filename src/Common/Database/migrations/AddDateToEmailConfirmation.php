<?php

namespace Common\Database\Migrations;

use Common\Core\App;
use Common\Core\Database;

class AddDateToEmailConfirmation
{
  public function up()
  {
    $db = App::inject()->getContainer(Database::class);
    if ($db === null) {
      throw new \Exception('Database connection could not be established.');
    }

    try {
      $db->query("ALTER TABLE email_confirmation ADD COLUMN date DATETIME NOT NULL");
      $db->query("ALTER TABLE email_confirmation CHANGE `cle` `cle` INT NOT NULL");
    } catch (\Throwable $e) {
      throw new \Exception("Error Processing Request :" . $e);
    }
  }

  public function down()
  {
    $db = App::inject()->getContainer(Database::class);
    if ($db === null) {
      throw new \Exception('Database connection could not be established.');
    }

    try {
      $db->query('ALTER TABLE email_confirmation DROP COLUMN date');
    } catch (\Throwable $e) {
      throw new \Exception("Error Processing Request :" . $e->getMessage());
    }
  }
}
