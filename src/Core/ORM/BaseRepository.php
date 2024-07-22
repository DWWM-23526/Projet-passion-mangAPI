<?php

namespace Core\ORM;

use Core\App;
use Core\Database;

abstract class BaseRepository
{

    protected Database $db;
    protected $table;
    protected $modelClass;
    protected $primaryKey;

    public function __construct()
    {
        $this->db = App::inject()->getContainer(Database::class);
    }


    // BASIC CRUD

    protected function getAll($table)
    {
        $result = $this->db->query("SELECT * FROM $table")->fetchAllOrFail();
        return array_map(fn ($data) => new $this->modelClass($data), $result);
    }

    protected function getBy(mixed $id, string $column)
    {
        $result = $this->db->query("SELECT * FROM $this->table WHERE $column = ?", [$id])->fetchOrFail();
        return new $this->modelClass($result);
    }

    protected function create(array $data)
    {
        $fields = implode(',', array_keys($data));
        $values = ':' . implode(',:', array_keys($data));

        return $this->db->query("INSERT INTO $this->table ($fields) VALUES ($values) ", $data);
    }

    protected function update(array $data, int $id)
    {
        $fields = '';

        foreach ($data as $key => $value) {
            if ($key != $this->primaryKey) {
                $fields .= "$key = :$key,";
            }
        }

        $fields = rtrim($fields, ',');
        $data[$this->primaryKey] = $id;

        return $this->db->query("UPDATE {$this->table} SET $fields WHERE {$this->primaryKey} = :{$this->primaryKey}", $data);
    }

    protected function delete(mixed $id, string $column)
    {
        return $this->db->query("DELETE FROM $this->table WHERE $column = ?", [$id]);
    }

    // ONE TO MANY

    /**
     * Summary of hasMany
     * @param mixed $relatedClass
     * @param string $relatedTable
     * @param string $foreignKey
     * @param int $localKeyId
     * @return object[]
     */
    protected function hasMany(mixed $relatedClass, string $relatedTable, string $foreignKey, int $localKeyId)
    {

        $result = $this->db->query("SELECT * FROM {$relatedTable} WHERE {$foreignKey} = ?", [$localKeyId])->fetchAllOrFail();
        return array_map(fn ($data) => new $relatedClass($data), $result);
    }

    // MANY TO ONE

    /**
     * Summary of belongTo
     * @param mixed $relatedClass
     * @param string $relatedTable
     * @param string $foreignKey
     * @param int $ownerKeyId
     * @return object
     */
    protected function belongTo(mixed $relatedClass, string $relatedTable, string $foreignKey, int $ownerKeyId)
    {
        $result = $this->db->query("SELECT * FROM {$relatedTable} WHERE {$foreignKey} = ?", [$ownerKeyId])->fetchOrFail();
        return new $relatedClass($result);
    }

    // MANY TO MANY

    /**
     * Summary of belongToMany
     * @param mixed $relatedClass
     * @param string $relatedTable
     * @param string $pivotTable
     * @param string $relatedkey
     * @param int $primaryKeyId
     * @return object[]
     */
    protected function belongToMany(mixed $relatedClass, string $relatedTable, string $pivotTable, string $relatedkey, int $primaryKeyId)
    {
        $result = $this->db->query("SELECT r.* FROM $relatedTable r JOIN $pivotTable p ON r.{$relatedkey} = p.{$relatedkey} WHERE p.{$this->primaryKey} = ?", [$primaryKeyId])->fetchAllOrFail();
        return array_map(fn ($data) => new $relatedClass($data), $result);
    }

    /**
     * Summary of attach
     * @param string $pivotTable
     * @param string $foreignKey
     * @param string $relatedKey
     * @param int $foreignkeyId
     * @param int $relatedKeyId
     * @return Database
     */
    protected function attach(string $pivotTable, string $foreignKey, string $relatedKey, int $foreignkeyId, int $relatedKeyId)
    {
        return $this->db->query("INSERT INTO $pivotTable ({$foreignKey}, {$relatedKey}) VALUES (:foreignkeyId, :relatedKeyId)", [':foreignkeyId' => $foreignkeyId, ':relatedKeyId' => $relatedKeyId]);
    }

    /**
     * Summary of detach
     * @param string $pivotTable
     * @param string $foreignKey
     * @param string $relatedKey
     * @param int $foreignkeyId
     * @param int $relatedKeyId
     * @return Database
     */
    protected function detach(string $pivotTable, string $foreignKey, string $relatedKey, int $foreignkeyId, int $relatedKeyId)
    {
        return $this->db->query("DELETE FROM $pivotTable WHERE {$foreignKey} = :foreignkeyId AND {$relatedKey} = :relatedKeyId", [':foreignkeyId' => $foreignkeyId, ':relatedKeyId' => $relatedKeyId]);
    }
}
