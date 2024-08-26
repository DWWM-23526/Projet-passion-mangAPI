<?php
namespace Database\Migrations;
use Core\ORM\Migration;

class AddNomColumnInRoleTable extends Migration
{
  public function up()
  {
    $query = "ALTER TABLE `role`
    DROP `utilisateur`,
    DROP `redacteur`,
    DROP `admin`";
    parent::upParent($query);
    $query2 = "ALTER TABLE `role` ADD `nom` VARCHAR(50) NOT NULL AFTER `id_role`";
    parent::upParent($query2);
    $query3 = "UPDATE `role` SET `nom` = 'Utilisateur' WHERE `role`.`id_role` = 1";
    parent::upParent($query3);
    $query4 = "UPDATE `role` SET `nom` = 'Redacteur' WHERE `role`.`id_role` = 2";
    parent::upParent($query4);
    $query5 = "UPDATE `role` SET `nom` = 'Admin' WHERE `role`.`id_role` = 3";
    parent::upParent($query5);
  }

  public function down()
  {
    //Todo: Faire le down
  }
}