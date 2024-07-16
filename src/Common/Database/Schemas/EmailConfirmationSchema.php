<?php

namespace Common\Database\Schemas;

use Common\Core\App;
use Common\Core\Database;

class EmailConfirmationSchema
{
  public function up()
  {
    $db = App::inject()->getContainer(Database::class);
    if ($db === null) {
      throw new \Exception("Database connection could not be established.");
    }

    $db->query("CREATE TABLE IF NOT EXISTS email_confirmation (
    id_conf INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    cle INT
    )");
  }
}
