<?php

namespace Core;

use Api\Users\Repository\UsersRespository;
use Api\Users\Service\UsersService;

use Core\ORM\DatabaseManager;
use Core\Router;

use Api\EmailConfirm\Repository\EmailConfirmRepository;
use Api\EmailConfirm\Service\EmailConfirmService;
use Favorites\Repository\FavoritesRepository;
use Favorites\Service\FavoritesService;
use Api\Manga\Repository\MangaRepository;
use Api\Manga\Service\MangaService;
use Api\Mangaka\Repository\MangakaRepository;
use Api\Mangaka\Service\MangakaService;
use Tags\Repository\TagsRepository;
use Tags\Service\TagsService;
use TagsManga\Repository\TagsMangaRepository;
use TagsManga\Service\TagsMangaService;

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

    // ROUTER INIT

    $app = Router::getInstance();
    
    require __DIR__ . "/../Api/EmailConfirm/emailConfirmEndPoint.php";
    require __DIR__ . "/../Api/Manga/mangaEndPoint.php";
    require __DIR__ . "/../Api/Mangaka/mangakaEndPoint.php";
    require __DIR__ . '/../Tags/tagEndPoint.php';
    require __DIR__ . '/../Api/Users/usersEndPoint.php';

    // TODO: Faire le fichier et dossier log / migration.log

    // CONTAINER INIT

    self::initMainContainer();
    self::initRepositoriesContainer();
    self::initServicesContainer();

    // DATABASE INIT

    if (!isset($_SESSION['initialized'])) {

      $_SESSION['initialized'] = true;

      $config = require __DIR__ . '/../../config/db.config.php';


      DatabaseManager::getInstance($config['database']);

      self::logMessage('App initialized');
    }

    return $app;
  }

  private static function initMainContainer()
  {
    $config = require __DIR__ . '/../../config/db.config.php';
    $container = new Container();

    $container->setContainer(Database::class, function () use ($config) {
      return Database::getInstance($config['database']);
    });

    self::setContainer($container);
  }


  private static function initRepositoriesContainer()
  {
    $containerRepositories = new Container();

    $containerRepositories->setContainer(MangaRepository::class, function () {
      return new MangaRepository();
    });

    $containerRepositories->setContainer(MangakaRepository::class, function () {
      return new MangakaRepository();
    });

    $containerRepositories->setContainer(FavoritesRepository::class, function () {
      return new FavoritesRepository();
    });

    $containerRepositories->setContainer(TagsMangaRepository::class, function () {
      return new TagsMangaRepository();
    });

    $containerRepositories->setContainer(EmailConfirmRepository::class, function () {
      return new EmailConfirmRepository();
    });

    $containerRepositories->setContainer(TagsRepository::class, function(){
      return new TagsRepository();
    });

    $containerRepositories->setContainer(UsersRespository::class, function(){
      return new UsersRespository();
    });

    self::setRepositoriesContainer($containerRepositories);
  }


  private static function initServicesContainer()
  {
    $containerServices = new Container();

    $containerServices->setContainer(MangaService::class, function () {
      return new MangaService();
    });

    $containerServices->setContainer(MangakaService::class, function () {
      return new MangakaService();
    });

    $containerServices->setContainer(FavoritesService::class, function () {
      return new FavoritesService();
    });

    $containerServices->setContainer(TagsMangaService::class, function () {
      return new TagsMangaService();
    });

    $containerServices->setContainer(EmailConfirmService::class, function () {
      return new EmailConfirmService();
    });

    $containerServices->setContainer(TagsService::class, function(){
      return new TagsService();
    });

    $containerServices->setContainer(UsersService::class, function(){
      return new UsersService();
    });

    self::setServiceContainer($containerServices);
  }


  private static function logMessage($message)
  {
    $logFile = __DIR__ . '/../../log/migration.log';
    $timestamp = date('Y-m-d H:i:s');
    $logEntry = "[$timestamp] $message\n";
    file_put_contents($logFile, $logEntry, FILE_APPEND);
  }
}
