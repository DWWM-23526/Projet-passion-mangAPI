<?php
namespace Auth\Endpoints;

use Core\EndPoints\_BaseApiEndpoint;

class RoleEndPoint extends _BaseApiEndpoint
{
  protected function getBasePath(): string
  {
    return '/api/role';
  }

  protected function getController(): string
  {
    return 'Auth\Controllers\RoleController';
  }
}