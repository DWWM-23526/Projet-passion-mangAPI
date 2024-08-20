<?php
namespace Database\Migrations;
use Core\ORM\Migration;

class AddColumnIdRoleInUsers extends Migration
{
  public function up()
  {
    $query = "ALTER TABLE `users` ADD `id_role` INT NOT NULL AFTER `is_deleted`";
    parent::upParent($query);
  }

  public function down()
  {
    //TODO: Faire le down
  }
}