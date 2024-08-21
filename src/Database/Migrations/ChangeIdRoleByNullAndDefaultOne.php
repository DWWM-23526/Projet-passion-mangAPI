<?php
namespace Database\Migrations;
use Core\ORM\Migration;

class ChangeIdRoleByNullAndDefaultOne extends Migration
{
  public function up()
  {
    $query = "ALTER TABLE `users` CHANGE `id_role` `id_role` INT NULL DEFAULT '1'";
    parent::upParent($query);
  }

  public function down()
  {
    $query = "ALTER TABLE `users` CHANGE `id_role` `id_role` INT NOT NULL";
    parent::downParent($query);
  }
}