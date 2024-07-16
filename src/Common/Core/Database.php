<?php

namespace Common\Core;

use Common\core\HTTPResponse;
use PDO;

class Database
{
    private static Database | null $instance = null;
    private PDO $connection;
    private mixed $statement;

    private function __construct(?array $config)
    {

        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['db']};charset={$config['charset']};collate={$config['collate']}";

        $option = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $this->connection = $this->connection($dsn, $config['user'], $config['pass'], $option);
    }

    // DATABASE INIT METHODS 

    public static function getInstance(array $config)
    {
        if (self::$instance === null) {
            self::$instance = new self($config);
        }

        return self::$instance;
    }

    private function connection(string $dns, string $user, string $pass, array $option)
    {

        try {
            $pdo = new PDO($dns, $user, $pass, $option);
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage(), (int)$e->getCode());
        }

        return $pdo;
    }

    // DATABASE METHODS 

    private function fetch()
    {
        return $this->statement->fetch();
    }

    private function fetchAll($fetchStyle)
    {
        return $this->statement->fetchAll($fetchStyle);
    }


    public function fetchOrFail()
    {
        $result = $this->fetch();

        if (!$result) {
            throw new \Exception('No results found.');
        }
        return $result;
    }

    public function fetchAllOrFail(int $fetchStyle = PDO::FETCH_ASSOC): array
    {
        $result = $this->fetchAll($fetchStyle, );
        if (!$result) {
            throw new \Exception('No results found.');
        }
        return $result;
    }

    public function fetchAllOrNull(int $fetchStyle = PDO::FETCH_ASSOC): array | null
    {
        $result = $this->fetchAll($fetchStyle, );
        if (!$result) {
            return null;
        }
        return $result;
    }

    public function query(string $query, array $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }
}
