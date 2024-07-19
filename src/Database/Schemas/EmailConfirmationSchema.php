<?php

namespace Database\Schemas;

use Core\App;
use Core\Database;

class EmailConfirmationSchema
{
  public function up()
  {
    $db = App::inject()->getContainer(Database::class);
    if ($db === null) {
      throw new \Exception("Database connection could not be established.");
    }

    try {

      $db->query("CREATE TABLE IF NOT EXISTS email_confirmation (
        id_conf INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(50) NOT NULL,
        cle INT
        )");
    } catch (\Throwable $e) {

      throw new \Exception("Error Processing Request :" . $e->getMessage());
    }
  }
}
