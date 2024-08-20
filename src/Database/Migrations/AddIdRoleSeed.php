<?php
namespace Database\Migrations;
use Core\ORM\Migration;

class AddIdRoleSeed extends Migration
{
  public function up()
  {
    $query1 = "UPDATE `users` SET `id_role` = 1 WHERE `users`.`Id_user` = 1";
    parent::upParent($query1);

    $query2 = "UPDATE `users` SET `id_role` = 1 WHERE `users`.`Id_user` = 2";
    parent::upParent($query2);

    $query3 = "UPDATE `users` SET `id_role` = 1 WHERE `users`.`Id_user` = 3";
    parent::upParent($query3);

    $query4 = "UPDATE `users` SET `id_role` = 1 WHERE `users`.`Id_user` = 4";
    parent::upParent($query4);
    
    $query5 = "UPDATE `users` SET `id_role` = 1 WHERE `users`.`Id_user` = 5";
    parent::upParent($query5);
  }

  public function down()
  {
    //TODO : Faire le down
  }
}