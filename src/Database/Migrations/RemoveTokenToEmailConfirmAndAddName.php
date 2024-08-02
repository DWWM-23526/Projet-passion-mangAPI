<?php

namespace Database\Migrations;

use Core\ORM\Migration;

class RemoveTokenToEmailConfirmAndAddName extends Migration
{
  public function up()
  {
    $query = "ALTER TABLE email_confirmation DROP COLUMN `token`";
    parent::upParent($query);
    $query2 = "ALTER TABLE email_confirmation ADD COLUMN `name` VARCHAR(50) NOT NULL AFTER `email`";
    parent::upParent($query2);
  }

  public function down()
  {
    // TODO: Faire le down de cette migration
  }
}
