<?php

namespace Database\Migrations;

use Core\ORM\Migration;

class AddColumnImgTagInTableTags extends Migration
{
  public function up()
  {
    $query = "ALTER TABLE `tags` ADD `img_tag` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL AFTER `tag_name`";
    parent::upParent($query);
  }

  public function down()
  {
    $query = "ALTER TABLE `tags` DROP `img_tag`";
    parent::downParent($query);
  }
}
