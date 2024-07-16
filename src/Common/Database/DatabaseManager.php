<?php

namespace Common\Database;

use Common\Database\Schemas\UserSchema;

class DatabaseManager
{
    private static ?DatabaseManager $instance = null;
    private ?\PDO $pdo = null;
    private array $config;

    private array $schemas = [
        UserSchema::class,
    ];

    private array $migrations = [
        
    ];

    private array $seeds = [
        
    ];
    
    private function __construct(array $config)
    {
        $this->config = $config;
        $this->checkDatabaseAndCreate();
        $this->checkTableAndCreate();
    }

    public static function getInstance(array $config): self
    {
        if (self::$instance === null) {
            self::$instance = new self($config);
        }

        return self::$instance;
    }

    public static function init()
    {

    }

    // DATABASE MIGRATION AND SEED METHODS 

    private function checkDatabaseAndCreate(): void
    {
        $dsn = "mysql:host={$this->config['host']};port={$this->config['port']};charset={$this->config['charset']}";
        
        $option = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        ];

        try {
          
            $this->pdo = new \PDO($dsn, $this->config['user'], $this->config['pass'], $option); 
            $result = $this->pdo->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '{$this->config['db']}'")->fetchColumn();

            if (!$result) {
                $this->pdo->exec("CREATE DATABASE `{$this->config['db']}` CHARSET {$this->config['charset']}");
            }
            
            if ($result > 1)
            {
                throw new \Exception('There is multiple DB with the same name');
                // abort
            }

        } catch (\PDOException $e) {

            throw new \Exception($e->getMessage(), (int)$e->getCode());

        } finally {

            $this->pdo = null;

        }
    }

    private function checkTableAndCreate()
    {
        foreach ($this->schemas as $schema) {
            (new $schema())->up();
        }
    }

    private function migration()
    {
        foreach ($this->migrations as $$migration) {
            (new $migration())->up();
        }
    }

    private function seed()
    {
        foreach ($this->seeds as $seed) {
            (new $seed())->up();
        }
    }

    
}