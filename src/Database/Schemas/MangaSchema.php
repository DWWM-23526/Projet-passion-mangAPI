<?php

namespace Database\Schemas;

use Core\App;
use Core\Database;

class MangaSchema
{
  public function up()
  {
    $db = App::inject()->getContainer(Database::class);
    if ($db === null) {
      throw new \Exception("Database connection could not be established");
    }

    try {

      $db->query("CREATE TABLE IF NOT EXISTS mangas (
        Id_manga INT AUTO_INCREMENT PRIMARY KEY,
        img_manga VARCHAR(255) NOT NULL,
        manga_name VARCHAR(75),
        edition varchar(50),
        total_tome_number INT,
        year_release DATE,
        tome_number INT,
        texte text,
        is_deleted BOOLEAN DEFAULT FALSE,
        Id_mangaka int,
        FOREIGN KEY (Id_mangaka) REFERENCES mangakas (Id_mangaka) ON DELETE SET NULL ON UPDATE CASCADE
        )");
    } catch (\Throwable $e) {

      throw new \Exception("Error Processing Request :" . $e->getMessage());
    }
  }
}
