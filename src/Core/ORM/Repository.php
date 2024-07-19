<?php 

namespace Core\ORM;

use Core\App;
use Core\Database;

class Repository
{

    protected Database $db;
    protected $table;

    public function __construct()
    {
        $this->db = App::inject()->getContainer(Database::class);
    }

    protected function getAll()
    {
        return $this->db->query("SELECT * FROM $this->table")->fetchAllOrFail();
    }
}