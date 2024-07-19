<?php

namespace Database\Schemas;

use Core\App;
use Core\Database;

class TagsSchema
{
  public function up()
  {
    $db = App::inject()->getContainer(Database::class);
    if ($db === null) {
      throw new \Exception("Database connection could not be established");
    }

    try {

      $db->query("CREATE TABLE IF NOT EXISTS tags (
        Id_tag INT AUTO_INCREMENT PRIMARY KEY,
        tag_name VARCHAR(50),
        is_deleted BOOLEAN DEFAULT FALSE
        )");
    } catch (\Throwable $e) {

      throw new \Exception("Error Processing Request :" . $e->getMessage());
    }
  }
}
