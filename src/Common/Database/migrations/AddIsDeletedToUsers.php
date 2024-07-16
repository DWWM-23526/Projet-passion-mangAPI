<?php

namespace Common\Database\Migrations;

use Common\Core\App;
use Common\Core\Database;

class AddIsDeletedToUsers
{
  public function up()
  {
    $db = App::inject()->getContainer(Database::class);
    if ($db === null) {
      throw new \Exception('Database connection could not be established.');
    }

    $db->query("ALTER TABLE users ADD COLUMN is_deleted TINYINT(1) DEFAULT 0");
  }

  public function down()
  {
    $db = App::inject()->getContainer(Database::class);
    if ($db === null) {
      throw new \Exception('Database connection could not be established.');
    }

    $db->query("ALTER TABLE users DROP COLUMN is_deleted");
  }
}