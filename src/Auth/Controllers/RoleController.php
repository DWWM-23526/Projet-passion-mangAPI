<?php
namespace Auth\Controllers;


use Api\Controllers\_BaseApiController;
use Api\Services\RoleService;
use Core\HTTPRequest;
use core\HTTPResponse;

class RoleController extends _BaseApiController
{

  public function __construct()
  {
    parent::__construct(RoleService::class);
  }
  
}