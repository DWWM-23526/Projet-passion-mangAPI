<?php

namespace Common\Database\Seed;

use Common\Core\App;
use Common\Core\Database;

class EmailConfirmationSeed
{
    public function up()
    {
        $db = App::inject()->getContainer(Database::class);
        if ($db === null) {
            throw new \Exception('Database connection could not be established.');
        }


        // $db->query("");
    }
}
