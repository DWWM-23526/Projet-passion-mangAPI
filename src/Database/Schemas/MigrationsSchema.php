<?php

namespace Database\Schemas;

use Core\App;
use Core\Database;

class MigrationsSchema
{
    public function up()
    {
        $db = App::inject()->getContainer(Database::class);
        if ($db === null) {
            throw new \Exception('Database connection could not be established.');
        }

        try {

            $db->query("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
        } catch (\Throwable $e) {

            throw new \Exception("Error Processing Request :" . $e->getMessage());
        }
    }
}
