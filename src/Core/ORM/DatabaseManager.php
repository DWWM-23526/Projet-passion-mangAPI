<?php

namespace Core\ORM;

use Core\App;
use Core\Database;
use Database\Migrations\AddChangeTokenVarcharToText;
use Database\Migrations\AddColumnIdRoleInUsers;
use Database\Migrations\AddDateToEmailConfirmation;
use Database\Migrations\AddForeignKeyIdRoleToUsers;
use Database\Migrations\AddIdRoleSeed;
use Database\Schemas\EmailConfirmationSchema;
use Database\Schemas\FavoritesSchema;
use Database\Schemas\MangakaSchema;
use Database\Schemas\MangaSchema;
use Database\Schemas\TagsMangaSchema;
use Database\Schemas\TagsSchema;
use Database\Schemas\MigrationsSchema;
use Database\Schemas\UsersSchema;

use Database\Migrations\AddIsDeletedToUsers;
use Database\Migrations\AddNomColumnInRoleTable;
use Database\Migrations\AddTableRoleAndSeed;
use Database\Migrations\AddUniqueMailAndRefactCleToToken;
use Database\Migrations\ChangeIdRoleByNullAndDefaultOne;
use Database\Migrations\DropAndReacreateFkTagMangaId_manga;
use Database\Migrations\DropAnRecreateFkTagMangaId_Tag;
use Database\Migrations\EditDateTypeToTimeStamp;
use Database\Migrations\RemoveTokenToEmailConfirmAndAddName;
use Database\Seed\FavoritesSeed;
use Database\Seed\MangakasSeed;
use Database\Seed\MangasSeed;
use Database\Seed\TagsMangasSeed;
use Database\Seed\TagsSeed;
use Database\Seed\UsersSeed;

class DatabaseManager
{
    private static ?DatabaseManager $instance = null;
    private ?\PDO $pdo = null;
    private array $config;

    private array $schemas = [
        MigrationsSchema::class,
        UsersSchema::class,
        MangakaSchema::class,
        MangaSchema::class,
        TagsSchema::class,
        TagsMangaSchema::class,
        FavoritesSchema::class,
        EmailConfirmationSchema::class
    ];

    private array $migrations = [
        AddIsDeletedToUsers::class,
        AddDateToEmailConfirmation::class,
        AddUniqueMailAndRefactCleToToken::class,
        AddChangeTokenVarcharToText::class,
        RemoveTokenToEmailConfirmAndAddName::class,
        EditDateTypeToTimeStamp::class,
        AddTableRoleAndSeed::class,
        AddColumnIdRoleInUsers::class,
        AddIdRoleSeed::class,
        AddForeignKeyIdRoleToUsers::class,
        ChangeIdRoleByNullAndDefaultOne::class,
        AddNomColumnInRoleTable::class,
        DropAndReacreateFkTagMangaId_manga::class,
        DropAnRecreateFkTagMangaId_Tag::class,
    ];

    private array $seeds = [
        UsersSeed::class,
        MangakasSeed::class,
        MangasSeed::class,
        TagsSeed::class,
        TagsMangasSeed::class,
        FavoritesSeed::class,
    ];


    private function __construct(array $config)
    {
        $this->config = $config;
        $this->checkDatabaseAndCreate();
        $this->checkTableAndCreate();
        $this->migrate();
        $this->seed();
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
                $this->pdo->exec("CREATE DATABASE `{$this->config['db']}` CHARSET {$this->config['charset']} COLLATE {$this->config['collate']}");
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
        $newMigrations = [];


        foreach ($this->migrations as $migration) {
            if (!in_array($migration, $appliedMigration)) {
                $newMigrations[] = $migration;
                (new $migration())->up();
                $this->logMigrations($migration);
            }
        }

        // if (empty($newMigrations)) {

        //     $this->logMessage("All migrations are applied.");
        // } else {

        //     $this->logMessage("Migration applied: " . implode(', ', $newMigrations));
        // }
    }

    private function seed()
    {
        $appliedMigration = $this->getAppliedMigrations();
        $newMigrations = [];

        foreach ($this->seeds as $seed) {
            if (!in_array($seed, $appliedMigration)) {
                $newMigrations[] = $seed;
                (new $seed())->up();
                $this->logMigrations($seed);
            }
        }

        // if (empty($newMigrations)) {

        //     $this->logMessage("All seeds are applied.");
        // } else {

        //     $this->logMessage("Seeds applied: " . implode(', ', $newMigrations));
        // }
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

    private function logMessage($message)
    {
        $logFile = __DIR__ . '/../../../log/migration.log';
        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "[$timestamp] $message\n";
        file_put_contents($logFile, $logEntry, FILE_APPEND);
    }
}
