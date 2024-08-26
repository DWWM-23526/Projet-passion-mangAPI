<?php
namespace Api\Users\Controller;

use Api\Users\Service\RoleService;
use Core\Base\BaseApiController;
use Core\HTTPRequest;
use core\HTTPResponse;

class RoleController extends BaseApiController
{

  public function __construct()
  {
    parent::__construct(RoleService::class);
  }
  
}