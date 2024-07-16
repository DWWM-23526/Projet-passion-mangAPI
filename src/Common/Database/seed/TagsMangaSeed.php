<?php

namespace Common\Database\Seed;

use Common\Core\App;
use Common\Core\Database;

class MangaSeed
{
    public function up()
    {
        $db = App::inject()->getContainer(Database::class);
        if ($db === null) {
            throw new \Exception('Database connection could not be established.');
        }

        $db->getConnection();
        $db->query("INSERT INTO `tags_manga` (`Id_manga`, `Id_tag`) VALUES
                    (1, 1), (2, 1), (3, 1), (4, 1), (5, 1),(6, 1), 
                    (7, 1), (8, 1), (9, 1), (10, 1), (12, 1), (15, 1), 
                    (16, 1), (17, 1), (18, 1),(19, 1), (20, 1), (21, 1),
                    (22, 1), (23, 1),(1, 2), (3, 2), (5, 2), (6, 2), (7, 2),
                    (11, 2),(13, 2), (14, 2), (15, 2), (17, 2), (18, 2),
                    (22, 2), (23, 2), (24, 2), (25, 2), (2, 3),(8, 3), 
                    (14, 3), (16, 3), (19, 3), (25, 3),(1, 4), (2, 4), 
                    (3, 4), (4, 4), (6, 4), (9, 4), (11, 4), (20, 4), 
                    (21, 4), (22, 4), (23, 4), (5, 5), (7, 5), (8, 5), 
                    (10, 5), (11, 5), (12, 5), (13, 5), (24, 5),(25, 5)");
    }
}