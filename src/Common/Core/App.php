<?php

namespace Common\Core;

use Common\Core\Router;

class App
{
  protected static Container $container;
  protected static Container $servicesContainer;
  protected static Container $repositoriesContainer;
  protected static Container $handlersContainer;


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

  // HANDLER

  protected static function setHandlersContainer(Container $container)
  {
    self::$handlersContainer = $container;
  }

  // INITIALIZATION

  public static function init()
  {
    // CONTAINER INIT
    $container = new Container();

    $container->setContainer(Database::class, function () {
      $config = require_once __DIR__ . '/../../config/db.config.php';
      Database::getInstance($config['database']);
    });

    App::setContainer($container);

    // REPOSITORIES CONTAINER INIT

    $containerRepositoties = new Container();

    App::setRepositoriesContainer($containerRepositoties);

    // SERVICES CONTAINER INIT

    $containerServices = new Container();

    App::setServiceContainer($containerServices);

    // HANDLER CONTAINER INIT
    $containerHandlers = new Container();

    App::setHandlersContainer($containerHandlers);

    // ROUTER INIT
    $router = new Router();

    $router->addRoute(RequestMethod::GET, '/manga', 'Manga\Controller\MangaController', 'index');

    return $router;
  }
}
