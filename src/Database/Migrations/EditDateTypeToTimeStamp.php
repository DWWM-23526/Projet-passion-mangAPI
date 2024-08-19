<?php

namespace Database\Migrations;

use Core\ORM\Migration;

class EditDateTypeToTimeStamp extends Migration
{
  public function up()
  {
    $query = "ALTER TABLE email_confirmation CHANGE `date` `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP";
    parent::upParent($query);
  }

  public function down()
  {
    // TODO: Faire le down de cette migration
  }
}
