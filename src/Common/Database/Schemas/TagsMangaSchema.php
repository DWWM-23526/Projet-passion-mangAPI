<?php

namespace Common\Database\Schemas;

use Common\Core\App;
use Common\Core\Database;

class TagsMangaSchema
{
  public function up()
  {
    $db = App::inject()->getContainer(Database::class);
    if ($db === null) {
      throw new \Exception("Database connection could not be established");
    }

    $db->getConnection();
    $db->query("CREATE TABLE IF NOT EXISTS tags_manga (
    Id_manga INT PRIMARY KEY,
    Id_tag INT PRIMARY KEY,
    FOREIGN KEY (Id_manga) REFERENCES mangas (Id_manga),
    FOREIGN KEY (Id_tag) REFERENCES tags (Id_tag)
    )");
  }
}
