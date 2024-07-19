<?php 

namespace Core\ORM;

use Core\App;
use Core\Database;

class Repository
{

    protected Database $db;
    protected $table;
    protected $modelClass;

    public function __construct()
    {
        $this->db = App::inject()->getContainer(Database::class);
    }

    protected function getAll()
    {
        $result = $this->db->query("SELECT * FROM $this->table")->fetchAllOrFail();
        return array_map(fn ($data) => new $this->modelClass($data), $result);
    }

    protected function getBy($id, $column)
    {
        $result = $this->db->query("SELECT * FROM $this->table WHERE {$column} = ?", [$id])->fetchOrFail();
        return new $this->modelClass($result);
    }

    protected function create($data)
    {
        $fields = implode(',', array_keys($data));
        $values = ':' . implode(',:', array_keys($data));

        $this->db->query("INSERT INTO $this->table ($fields) VALUES ($values) ", $data);
    }

}