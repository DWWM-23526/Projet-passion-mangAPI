<?php

namespace Database\Migrations;

use Core\ORM\Migration;

class DropAndReacreateFkTagMangaId_manga extends Migration
{
    public function up()
    {
        $query1 = "
        ALTER TABLE tags_manga DROP FOREIGN KEY tags_manga_ibfk_1;
    ";
        $query2 = "
    ALTER TABLE tags_manga
    ADD CONSTRAINT tags_manga_ibfk_1 FOREIGN KEY (Id_manga) REFERENCES mangas (Id_manga) ON DELETE CASCADE;
    ";
        parent::upParent($query1);
        parent::upParent($query2);
    }

    public function down() {}
}
