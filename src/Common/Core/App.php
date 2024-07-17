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


  public static function getInstance(): App
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  // CONTAINER 
  private static function setContainer(Container $container)
  {
    self::$container = $container;
  }

  public static function inject()
  {
    return self::$container;
  }

  // SERVICES
  private static function setServiceContainer(Container $container)
  {
    self::$servicesContainer = $container;
  }

  public static function injectService()
  {
    return self::$servicesContainer;
  }

  // REPOSITORIES

  private static function setRepositoriesContainer(Container $container)
  {
    self::$repositoriesContainer = $container;
  }

  public static function injectRepository()
  {
    return self::$repositoriesContainer;
  }

  // INITIALIZATION

  public static function init()
  {

    self::getInstance();

    $router = new Router();
    $router->addRoute(RequestMethod::GET, '/manga', 'Manga\Controller\MangaController', 'index');

    if (isset($_SESSION['initialized']) && $_SESSION['initialized']) {
      return $router;
    }

    $_SESSION['initialized'] = true;

    $config = require __DIR__ . '/../../../config/db.config.php';

    // Container INIT
    
    self::initMainContainer();
    self::initRepositoriesContainer();
    self::initServicesContainer();


    // DATABASE INIT
    DatabaseManager::getInstance($config['database']);

    return $router;
  }

  private static function initMainContainer()
  {
    $config = require __DIR__ . '/../../../config/db.config.php';
    $container = new Container();

    $container->setContainer(Database::class, function () use ($config) {
      return Database::getInstance($config['database']);
    });

    App::setContainer($container);
  }

  private static function initRepositoriesContainer()
  {
    $containerRepositories = new Container();

    App::setRepositoriesContainer($containerRepositories);
  }

  private static function initServicesContainer()
  {
    $containerServices = new Container();

    App::setServiceContainer($containerServices);
  }
}
