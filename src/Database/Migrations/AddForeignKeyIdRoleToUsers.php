<?php

namespace Database\Migrations;

use Core\ORM\Migration;

class AddForeignKeyIdRoleToUsers extends Migration
{
  public function up()
  {
    $query = "ALTER TABLE `users` ADD FOREIGN KEY (`id_role`) REFERENCES `role`(`id_role`) ON DELETE RESTRICT ON UPDATE RESTRICT";
    parent::upParent($query);
  }

  public function down()
  {
    //TODO: Faire le down
  }
}
