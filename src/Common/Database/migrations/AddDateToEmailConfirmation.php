<?php

namespace Common\Database\Migrations;

use Common\Core\App;
use Common\Core\Database;

class AddDateToEmailConfirmation extends BaseMigration
{
  public function up()
  {
    $query = "ALTER TABLE email_confirmation ADD COLUMN date DATETIME NOT NULL";
    parent::upParent($query);
  }

  public function down()
  {
    $query = "ALTER TABLE email_confirmation DROP COLUMN date";
    parent::downParent($query);
  }
}