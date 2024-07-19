<?php

namespace Database\Schemas;

use Core\App;
use Core\Database;

class UsersSchema
{
    public function up()
    {
        $db = App::inject()->getContainer(Database::class);
        if ($db === null) {
            throw new \Exception('Database connection could not be established.');
        }

        try {

            $db->query("CREATE TABLE IF NOT EXISTS users (
                Id_user INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL
            )");
        } catch (\Throwable $e) {

            throw new \Exception("Error Processing Request :" . $e->getMessage());
        }
    }
}
