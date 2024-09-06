<?php

namespace Database\Migrations;

use Core\ORM\Migration;

class EditTableMangakaImgMangaka extends Migration
{
  public function up()
  {
    $query = "ALTER TABLE `mangakas` CHANGE `img_mangaka` `img_mangaka` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL";
    parent::upParent($query);

    $query2 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 1";
    parent::upParent($query2);

    $query3 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 2";
    parent::upParent($query3);

    $query4 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 3";
    parent::upParent($query4);

    $query5 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 4";
    parent::upParent($query5);

    $query6 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 5";
    parent::upParent($query6);

    $query7 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 6";
    parent::upParent($query7);

    $query8 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 7";
    parent::upParent($query8);

    $query9 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 8";
    parent::upParent($query9);

    $query10 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 9";
    parent::upParent($query10);

    $query11 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 10";
    parent::upParent($query11);

    $query12 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 11";
    parent::upParent($query12);

    $query13 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 12";
    parent::upParent($query13);

    $query14 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 13";
    parent::upParent($query14);

    $query15 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 14";
    parent::upParent($query15);

    $query16 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 15";
    parent::upParent($query16);

    $query17 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 16";
    parent::upParent($query17);

    $query18 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 17";
    parent::upParent($query18);

    $query19 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 18";
    parent::upParent($query19);

    $query20 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 19";
    parent::upParent($query20);

    $query21 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 20";
    parent::upParent($query21);

    $query22 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 21";
    parent::upParent($query22);

    $query23 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 22";
    parent::upParent($query23);

    $query24 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 23";
    parent::upParent($query24);

    $query25 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 24";
    parent::upParent($query25);

    $query26 = "UPDATE `mangakas` SET `img_mangaka` = NULL WHERE `mangakas`.`Id_mangaka` = 25";
    parent::upParent($query26);
  }

  public function down()
  {
    //TODO: Faire le down
  }
}
