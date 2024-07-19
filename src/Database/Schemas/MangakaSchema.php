<?php

namespace Database\Schemas;

use Core\App;
use Core\Database;

class MangakaSchema
{
  public function up()
  {
    $db = App::inject()->getContainer(Database::class);
    if ($db === null) {
      throw new \Exception("Database connection could not be established.");
    }

    try {

      $db->query("CREATE TABLE IF NOT EXISTS mangakas (
        Id_mangaka INT AUTO_INCREMENT PRIMARY KEY,
        img_mangaka VARCHAR(255) NOT NULL,
        first_name VARCHAR(50),
        last_name VARCHAR(50),
        birthdate DATE,
        texte TEXT,
        is_deleted BOOLEAN DEFAULT FALSE
       )");
    } catch (\Throwable $e) {

      throw new \Exception("Error Processing Request :" . $e->getMessage());
    }
  }
}
