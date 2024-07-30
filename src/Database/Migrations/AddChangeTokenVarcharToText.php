<?php

namespace Database\Migrations;

use Core\ORM\Migration;

class AddChangeTokenVarcharToText extends Migration
{
  public function up()
  {
    $query = "ALTER TABLE email_confirmation CHANGE `token` `token` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL";
    parent::upParent($query);
  }

  public function down()
  {
    // TODO: Faire le down de cette migration
  }
}
