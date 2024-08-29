<?php
namespace Auth\Controllers;


use Core\Controllers\_BaseApiController;
use Auth\Services\RoleService;
use Core\HTTPRequest;
use core\HTTPResponse;

class RoleController extends _BaseApiController
{

  public function __construct()
  {
    parent::__construct(RoleService::class);
  }
  
}