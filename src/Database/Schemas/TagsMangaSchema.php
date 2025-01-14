<?php

namespace Database\Schemas;

use Core\App;
use Core\Database;

class TagsMangaSchema
{
  public function up()
  {
    $db = App::inject()->getContainer(Database::class);
    if ($db === null) {
      throw new \Exception("Database connection could not be established");
    }

    try {

      $db->query("CREATE TABLE IF NOT EXISTS tags_manga (
        Id_manga INT,
        Id_tag INT,
        PRIMARY KEY (Id_manga,Id_tag),
        FOREIGN KEY (Id_manga) REFERENCES mangas (Id_manga),
        FOREIGN KEY (Id_tag) REFERENCES tags (Id_tag)
        )");
    } catch (\Throwable $e) {

      throw new \Exception("Error Processing Request :" . $e->getMessage());
    }
  }
}
