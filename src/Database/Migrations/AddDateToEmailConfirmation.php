<?php

namespace Database\Migrations;

use Core\ORM\Migration;

class AddDateToEmailConfirmation extends Migration
{
  public function up()
  {
    $query = "ALTER TABLE email_confirmation ADD COLUMN date DATETIME NOT NULL";
    parent::upParent($query);
    $query2 = "ALTER TABLE email_confirmation CHANGE `cle` `cle` INT NOT NULL";
    parent::upParent($query2);
  }

  public function down()
  {
    $query = "ALTER TABLE email_confirmation DROP COLUMN date";
    parent::downParent($query);
  }
}