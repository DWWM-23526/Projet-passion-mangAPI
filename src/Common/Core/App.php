<?php

namespace Common\Core;

use Common\Core\Router;

class App
{
  protected static Container $container;
  protected static Container $servicesContainer;
  protected static Container $repositoriesContainer;


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
    $config = require __DIR__ . '/../../../config/db.config.php';



    // CONTAINER INIT
    $container = new Container();

    $container->setContainer(Database::class, function () use ($config) {
      return Database::getInstance($config['database']);
    });

    App::setContainer($container);

    // REPOSITORIES CONTAINER INIT

    $containerRepositoties = new Container();

    App::setRepositoriesContainer($containerRepositoties);

    // SERVICES CONTAINER INIT

    $containerServices = new Container();

    App::setServiceContainer($containerServices);


    // DATABASE INIT
    DatabaseManager::getInstance($config['database']);

    // ROUTER INIT
    $router = new Router();

    $router->addRoute(RequestMethod::GET, '/manga', 'Manga\Controller\MangaController', 'index');

    return $router;
  }
}
