<?php

namespace Common\Database\Migrations;

use Common\Core\App;
use Common\Core\Database;

class AddIsDeletedToUsers extends BaseMigration
{
  public function up()
  {
    $query = "ALTER TABLE users ADD COLUMN is_deleted TINYINT(1) DEFAULT 0";
    parent::upParent($query);
  }

  public function down()
  {
    $query = "ALTER TABLE users DROP COLUMN is_deleted";
    parent::downParent($query);
  }
}
