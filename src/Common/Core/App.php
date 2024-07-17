<?php

namespace Common\Core;

use Common\Core\Router;
use Common\Database\DatabaseManager;

class App
{
  private static ?App $instance = null;

  protected static Container $container;
  protected static Container $servicesContainer;
  protected static Container $repositoriesContainer;

  private function __construct()
  {
  }

  public static function getInstance(): App
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  private static function setContainer(Container $container)
  {
    self::$container = $container;
  }

  public static function inject()
  {
    return self::$container;
  }

  private static function setServiceContainer(Container $container)
  {
    self::$servicesContainer = $container;
  }

  public static function injectService()
  {
    return self::$servicesContainer;
  }

  private static function setRepositoriesContainer(Container $container)
  {
    self::$repositoriesContainer = $container;
  }

  public static function injectRepository()
  {
    return self::$repositoriesContainer;
  }

  public static function init()
  {
    self::getInstance();
    $app = Router::getInstance();

    $app->addRoute(RequestMethod::GET, '/manga', 'Manga\Controller\MangaController', 'index');

    if (!isset($_SESSION['initialized'])) {

      $_SESSION['initialized'] = true;

      $config = require __DIR__ . '/../../../config/db.config.php';

      self::initMainContainer();
      self::initRepositoriesContainer();
      self::initServicesContainer();

      DatabaseManager::getInstance($config['database']);

      self::logMessage('App initialized');
    }

    return $app;
  }

  private static function initMainContainer()
  {
    $config = require __DIR__ . '/../../../config/db.config.php';
    $container = new Container();

    $container->setContainer(Database::class, function () use ($config) {
      return Database::getInstance($config['database']);
    });

    self::setContainer($container);
  }

  private static function initRepositoriesContainer()
  {
    $containerRepositories = new Container();
    self::setRepositoriesContainer($containerRepositories);
  }

  private static function initServicesContainer()
  {
    $containerServices = new Container();
    self::setServiceContainer($containerServices);
  }

  private static function logMessage($message)
  {
    $logFile = __DIR__ . '/../../../log/migration.log';
    $timestamp = date('Y-m-d H:i:s');
    $logEntry = "[$timestamp] $message\n";
    file_put_contents($logFile, $logEntry, FILE_APPEND);
  }
}
