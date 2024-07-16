<?php

namespace Common\Database\Schemas;

use Common\Core\App;
use Common\Core\Database;

class MigrationsSchema
{
    public function up()
    {
        $db = App::inject()->getContainer(Database::class);
        if ($db === null) {
            throw new \Exception('Database connection could not be established.');
        }

       
        $db->query("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
    }
}