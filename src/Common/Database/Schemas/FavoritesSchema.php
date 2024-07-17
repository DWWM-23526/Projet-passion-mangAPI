<?php

namespace Common\Database\Schemas;

use Common\Core\App;
use Common\Core\Database;

class FavoritesSchema
{
  public function up()
  {
    $db = App::inject()->getContainer(Database::class);
    if ($db === null) {
      throw new \Exception("Database connection could not be established.");
    }


    try {

      $db->query("CREATE TABLE IF NOT EXISTS favoris (
        Id_manga INT,
        Id_user INT,
        PRIMARY KEY (Id_manga,Id_user),
        FOREIGN KEY (Id_manga) REFERENCES mangas (Id_manga),
        FOREIGN KEY (Id_user) REFERENCES users (Id_user)
        )");
    } catch (\Throwable $e) {

      throw new \Exception("Error Processing Request :" . $e->getMessage());
    }
  }
}
