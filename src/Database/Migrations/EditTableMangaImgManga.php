<?php

namespace Database\Migrations;

use Core\ORM\Migration;

class EditTableMangaImgManga extends Migration
{
  public function up()
  {
    $query = "ALTER TABLE `mangas` CHANGE `img_manga` `img_manga` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL";
    parent::upParent($query);

    $query2 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 1";
    parent::upParent($query2);

    $query3 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 2";
    parent::upParent($query3);

    $query4 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 3";
    parent::upParent($query4);

    $query5 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 4";
    parent::upParent($query5);

    $query6 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 5";
    parent::upParent($query6);

    $query7 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 6";
    parent::upParent($query7);

    $query8 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 7";
    parent::upParent($query8);

    $query9 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 8";
    parent::upParent($query9);

    $query10 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 9";
    parent::upParent($query10);

    $query11 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 10";
    parent::upParent($query11);

    $query12 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 11";
    parent::upParent($query12);

    $query13 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 12";
    parent::upParent($query13);

    $query14 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 13";
    parent::upParent($query14);

    $query15 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 14";
    parent::upParent($query15);

    $query16 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 15";
    parent::upParent($query16);

    $query17 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 16";
    parent::upParent($query17);

    $query18 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 17";
    parent::upParent($query18);

    $query19 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 18";
    parent::upParent($query19);

    $query20 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 19";
    parent::upParent($query20);

    $query21 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 20";
    parent::upParent($query21);

    $query22 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 21";
    parent::upParent($query22);

    $query23 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 22";
    parent::upParent($query23);

    $query24 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 23";
    parent::upParent($query24);

    $query25 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 24";
    parent::upParent($query25);

    $query26 = "UPDATE `mangas` SET `img_manga` = NULL WHERE `mangas`.`Id_manga` = 25";
    parent::upParent($query26);
  }

  public function down()
  {
    //TODO: Faire le down
  }
}
