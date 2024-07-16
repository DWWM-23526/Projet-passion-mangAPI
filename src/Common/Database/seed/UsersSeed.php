<?php

namespace Common\Database\Seed;

use Common\Core\App;
use Common\Core\Database;

class UsersSeed
{
    public function up()
    {
        $db = App::inject()->getContainer(Database::class);
        if ($db === null) {
            throw new \Exception('Database connection could not be established.');
        }

        try {
            $db->query("INSERT INTO `users` (`Id_user`, `name`, `email`, `password`) VALUES
            (1, 'password123', 'user1@example.com', 'UserOne'),
            (2, 'password456', 'user2@example.com', 'UserTwo'),
            (3, 'password789', 'user3@example.com', 'UserThree'),
            (4, 'password321', 'user4@example.com', 'UserFour'),
            (5, 'password654', 'user5@example.com', 'UserFive')");
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        
    }
}