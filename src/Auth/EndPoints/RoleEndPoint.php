<?php
namespace Auth\Endpoints;

use Api\EndPoints\_BaseApiEndpoint;

class RoleEndPoint extends _BaseApiEndpoint
{
  protected function getBasePath(): string
  {
    return '/api/role';
  }

  protected function getController(): string
  {
    return 'Api\Controllers\RoleController';
  }
}