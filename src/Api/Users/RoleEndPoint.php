<?php
namespace Api\Users;

use Api\EndPoints\_BaseApiEndpoint;

class RoleEndPoint extends _BaseApiEndpoint
{
  protected function getBasePath(): string
  {
    return '/api/role';
  }

  protected function getController(): string
  {
    return 'Api\Users\Controller\RoleController';
  }
}