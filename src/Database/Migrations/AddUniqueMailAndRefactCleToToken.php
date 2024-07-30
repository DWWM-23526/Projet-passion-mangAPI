<?php
namespace Database\Migrations;
use Core\ORM\Migration;

class AddUniqueMailAndRefactCleToToken extends Migration
{
  public function up()
  {
    $query = "ALTER TABLE email_confirmation CHANGE `cle` `token` VARCHAR(255) NOT NULL";
    parent::upParent($query);
    $query2 = "ALTER TABLE email_confirmation ADD UNIQUE (`email`)";
    parent::upParent($query2);
  }

  public function down()
  {
    // TODO: Faire le down de cette migration
  }
}