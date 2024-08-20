<?php

namespace Database\Migrations;

use Core\ORM\Migration;

class AddTableRoleAndSeed extends Migration
{
  public function up()
  {
    $query = "CREATE TABLE `api_passion_manga`.`role` (`id_role` INT NOT NULL AUTO_INCREMENT , `utilisateur` TINYINT NOT NULL DEFAULT '1' , `redacteur` TINYINT NOT NULL DEFAULT '2' , `admin` TINYINT NOT NULL DEFAULT '3' , PRIMARY KEY (`id_role`)) ENGINE = InnoDB;";
    parent::upParent($query);
    $query2 = "INSERT INTO role (utilisateur, redacteur, admin) VALUES 
    (1, 0, 0),
    (0, 1, 0),
    (0, 0, 1)
    ";
    parent::upParent($query2);
  }

  public function down()
  {
    // TODO : Faire le down
  }
}