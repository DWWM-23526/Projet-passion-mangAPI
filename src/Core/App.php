<?php
namespace Core;


use Core\ORM\DatabaseManager;
use Core\Router;


use Auth\Services\RoleService;
use Auth\Services\UsersService;
use Auth\Services\MailerService;
use Auth\Services\AuthService;

use Auth\EndPoints\AuthEndpoint;
use Auth\Endpoints\UsersEndpoint;
use Auth\Endpoints\RoleEndPoint;
use Auth\EndPoints\EmailConfirmEndPoint;

use Auth\Repositories\RoleRepository;
use Auth\Repositories\UsersRepository;
use Auth\Repositories\EmailExpiration;

use Api\Services\MangaService;
use Api\Services\MangakaService;
use Api\Services\TagsService;


use Api\Repositories\MangaRepository;
use Api\Repositories\MangakaRepository;
use Api\Repositories\TagsRepository;


use Api\EndPoints\MangaEndpoint;
use Api\Endpoints\MangakaEndPoint;
use Api\Endpoints\TagsEndpoint;
use Auth\Repositories\EmailConfirmRepository;
use Auth\Services\EmailConfirmService;

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

    MangaEndpoint::create();
    MangakaEndPoint::create();
    EmailConfirmEndPoint::create();
    TagsEndpoint::create();
    UsersEndpoint::create();
    AuthEndpoint::create();
    RoleEndPoint::create();

    // CONTAINER INIT

    self::initMainContainer();
    self::initRepositoriesContainer();
    self::initServicesContainer();

    // DATABASE INIT

    if (!isset($_SESSION['initialized'])) {

      $_SESSION['initialized'] = true;

      $config = require __DIR__ . '/../../config/db.config.php';


      DatabaseManager::getInstance($config['database']);

      // self::logMessage('App initialized');
    }

    self::instanceEmailExpiration();

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

    $containerRepositories->setContainer(EmailConfirmRepository::class, function () {
      return new EmailConfirmRepository();
    });

    $containerRepositories->setContainer(TagsRepository::class, function () {
      return new TagsRepository();
    });

    $containerRepositories->setContainer(UsersRepository::class, function () {
      return new UsersRepository();
    });

    $containerRepositories->setContainer(RoleRepository::class, function () {
      return new RoleRepository();
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

    $containerServices->setContainer(EmailConfirmService::class, function () {
      return new EmailConfirmService();
    });

    $containerServices->setContainer(TagsService::class, function () {
      return new TagsService();
    });

    $containerServices->setContainer(UsersService::class, function () {
      return new UsersService();
    });

    $containerServices->setContainer(AuthService::class, function () {
      return new AuthService();
    });

    $containerServices->setContainer(MailerService::class, function () {
      return new MailerService();
    });

    $containerServices->setContainer(RoleService::class, function () {
      return new RoleService();
    });

    self::setServiceContainer($containerServices);
  }
  
  private static function instanceEmailExpiration()
  {
    $instanceOfEmailExpiration = new EmailExpiration();
    $instanceOfEmailExpiration->deleteWhenExpiredEmailConfirm();
  }



  private static function logMessage($message)
  {
    $logFile = __DIR__ . '/../../log/migration.log';
    $timestamp = date('Y-m-d H:i:s');
    $logEntry = "[$timestamp] $message\n";
    file_put_contents($logFile, $logEntry, FILE_APPEND);
  }
}
