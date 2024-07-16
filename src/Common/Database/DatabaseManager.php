<?php

namespace Common\Database;

use Common\Database\Schemas\EmailConfirmationSchema;
use Common\Database\Schemas\FavoritesSchema;
use Common\Database\Schemas\MangakaSchema;
use Common\Database\Schemas\MangaSchema;
use Common\Database\Schemas\TagsMangaSchema;
use Common\Database\Schemas\TagsSchema;
use Common\Core\App;
use Common\Core\Database;
use Common\Database\Migrations\AddIsDeletedToUsers;
use Common\Database\Schemas\MigrationsSchema;
use Common\Database\Schemas\UsersSchema;

class DatabaseManager
{
    private static ?DatabaseManager $instance = null;
    private ?\PDO $pdo = null;
    private array $config;

    private array $schemas = [
        UserSchema::class,
    ];

    private array $migrations = [
        AddIsDeletedToUsers::class,
    ];

    private array $seeds = [];

    private function __construct(array $config)
    {
        $this->config = $config;
        $this->checkDatabaseAndCreate();
        $this->checkTableAndCreate();
        $this->migrate();

    }

    public static function getInstance(array $config): self
    {
        if (self::$instance === null) {
            self::$instance = new self($config);
        }

        return self::$instance;
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

            if ($result > 1) {
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

    private function migrate()
    {

        $appliedMigration = $this->getAppliedMigrations();
        var_dump($appliedMigration);
        $newMigrations = [];


        foreach ($this->migrations as $migration) {
            if (!in_array($migration, $appliedMigration)){
                $newMigrations[] = $migration;
                (new $migration())->up();  
                $this->logMigrations($migration);             
            }
        }

        if (empty($newMigrations))
        {

            echo "All migrations are applied.";

        } else {

            echo "Migrations applied: " . implode(', ', $newMigrations);
        }

    }

    private function seed()
    {
        foreach ($this->seeds as $seed) {
            (new $seed())->up();
        }
    }

    private function getAppliedMigrations()
    {

        $db = App::inject()->getContainer(Database::class);

        if ($db === null) {
            throw new \Exception('Database connection could not be established.');
        }

        $result = $db->query("SELECT migration FROM migrations")->fetchAllOrNull(\PDO::FETCH_COLUMN);

        if ($result === null) {
            $result = [];
        }
        
        return $result;
    }

    private function logMigrations(string $migration)
    {
        $db = App::inject()->getContainer(Database::class);

        if ($db === null) {
            throw new \Exception('Database connection could not be established.');
        }

        $result = $db->query("INSERT INTO migrations (migration) VALUES (:migration)", ['migration' => $migration]);
    }
}
