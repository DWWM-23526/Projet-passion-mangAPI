<?php
namespace Common\Database\Schemas;

use Common\Core\App;
use Common\Core\Database;

class MangaSchema
{
  public function up()
  {
    $db = App::inject()->getContainer(Database::class);
    if ($db === null) {
      throw new \Exception("Database connection could not be established");
    }
    
    $db->query("CREATE TABLE IF NOT EXISTS mangas (
    Id_manga INT AUTO_INCREMENT PRIMARY KEY,
    img_manga VARCHAR(255) NOT NULL,
    manga_name VARCHAR(75) NOT NULL
    )");
  }
}