<?php

namespace Common\Database\Seed;

use Common\Core\App;
use Common\Core\Database;

class TagsSeed
{
    public function up()
    {
        $db = App::inject()->getContainer(Database::class);
        if ($db === null) {
            throw new \Exception('Database connection could not be established.');
        }

        $db->getConnection();
        try {
            $db->query("INSERT INTO `tags` (`Id_tag`, `tag_name`) VALUES
                    (1, 'Action'),
                    (2, 'Aventure'),
                    (3, 'Fantaisie'),
                    (4, 'Shonen'),
                    (5, 'Drame');");
    
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
        
}