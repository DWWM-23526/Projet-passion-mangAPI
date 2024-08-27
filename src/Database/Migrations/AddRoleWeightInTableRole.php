<?php
namespace Database\Migrations;
use Core\ORM\Migration;

class AddRoleWeightInTableRole extends Migration
{
  public function up()
  {
    $query = "ALTER TABLE `role` ADD `role_weight` INT NOT NULL DEFAULT '1' AFTER `nom`";
    parent::upParent($query);

    $query2 = "UPDATE `role` SET `role_weight` = '2' WHERE `role`.`id_role` = 2";
    parent::upParent($query2);

    $query3 = "UPDATE `role` SET `role_weight` = '3' WHERE `role`.`id_role` = 3";
    parent::upParent($query3);
  }

  public function down()
  {
    $query = "ALTER TABLE `role` DROP `role_weight`";
    parent::downParent($query);
  }
}