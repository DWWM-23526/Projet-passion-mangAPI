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
        return array_map(fn($data) => new $this->modelClass($data), $result);
    }

    protected function getById(int $id)
    {
        $result = $this->db->query("SELECT * FROM $this->table WHERE $this->primaryKey = ?", [$id])->fetchOrFail();
        return new $this->modelClass($result);
    }

    protected function getBy(mixed $value, string $column)
    {
        $result = $this->db->query("SELECT * FROM $this->table WHERE $column = ?", [$value])->fetchOrFail();
        return new $this->modelClass($result);
    }

    protected function search(array $values, array $columns)
    {
        if (empty($values) || empty($columns)) {
            throw new \Exception("Values and columns cannot be empty.");
        }

        $query = "SELECT * FROM $this->table";
        $conditions = [];

        foreach ($values as $value) {
            $columnConditions = array_map(fn($column) => "$column LIKE ?", $columns);
            $conditions[] = '(' . implode(' OR ', $columnConditions) . ')';
        }

        $fullCondition = ' WHERE ' . implode(' AND ', $conditions);
        $likeValues = array_fill(0, count($values) * count($columns), "%$value%");

        $result = $this->db->query($query . $fullCondition, $likeValues)->fetchAllOrFail();
        return array_map(fn($data) => new $this->modelClass($data), $result);
    }

    /**
     * Summary of checkIfExists
     * @param string $table
     * @param array $values
     * @param array $columns
     * @return array
     */
    protected function checkIfExists(string $table, array $values, array $columns)
    {
        if (count($values) == count($columns)) {
            $begin = "SELECT COUNT(*) AS result FROM $table";
            $wheres = "";
            for ($i = 0; $i < count($values); $i++) {
                if ($i == 0) {
                    $wheres = $wheres . " WHERE " . $columns[$i] . " = ?";
                } else {
                    $wheres = $wheres . " AND " . $columns[$i] . " = ?";
                }
            }
            $result = $this->db->query($begin . $wheres, $values)->fetchAllOrFail();
            return $result;
        }
        throw new \Exception("Invalid Request");
    }

    protected function create(array $data)
    {
        $fields = implode(',', array_keys($data));
        $values = ':' . implode(',:', array_keys($data));

        try {
            $this->db->query("INSERT INTO $this->table ($fields) VALUES ($values) ", $data);
            $id = $this->db->lastInsertId();
            $response = $this->getById($id);
        } catch (\PDOException $th) {
            throw new \Exception($th->getMessage());
        }
        var_dump($response);
        return $response;
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

        try {
            $this->db->query("UPDATE {$this->table} SET $fields WHERE {$this->primaryKey} = :{$this->primaryKey}", $data);
            $response = $this->getById($id);
        } catch (\PDOException $th) {
            throw new \Exception($th->getMessage());
        }

        return $response;
    }

    protected function delete(mixed $id, string $column)
    {
        return $this->db->query("DELETE FROM $this->table WHERE $column = ?", [$id]);
    }

    protected function deleteWhenExpired()
    {
        $expiration_time = 600;
        return $this->db->query("DELETE FROM email_confirmation WHERE UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(date) > :expiration_time", [$expiration_time]);
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
        return array_map(fn($data) => new $relatedClass($data), $result);
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
        return array_map(fn($data) => new $relatedClass($data), $result);
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
