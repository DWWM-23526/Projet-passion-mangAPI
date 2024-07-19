<?php

namespace Database\Seed;

use Core\App;
use Core\Database;

class TagsSeed
{
    public function up()
    {
        $db = App::inject()->getContainer(Database::class);
        if ($db === null) {
            throw new \Exception('Database connection could not be established.');
        }

        try {
            $db->query("INSERT INTO `tags` (`Id_tag`, `tag_name`) VALUES
                    (1, 'Action'),
                    (2, 'Aventure'),
                    (3, 'Fantaisie'),
                    (4, 'Shonen'),
                    (5, 'Drame');");
    
        } catch (\Throwable $e) {
            throw new \Exception("Error Processing Request :" . $e->getMessage());
        }
    }
        
}