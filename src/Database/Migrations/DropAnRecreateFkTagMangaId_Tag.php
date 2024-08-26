<?php

namespace Database\Migrations;

use Core\ORM\Migration;

class DropAnRecreateFkTagMangaId_Tag extends Migration
{
    public function up()
    {
        $query1 = "
        ALTER TABLE `api_passion_manga`.`tags_manga` DROP FOREIGN KEY `tags_manga_ibfk_2`;
    ";
        $query2 = "
        ALTER TABLE `api_passion_manga`.`tags_manga` ADD FOREIGN KEY (`Id_tag`) REFERENCES `api_passion_manga`.`tags` (`Id_tag`) ON DELETE CASCADE;
    ";
        parent::upParent($query1);
        parent::upParent($query2);
    }

    public function down() {}
}
