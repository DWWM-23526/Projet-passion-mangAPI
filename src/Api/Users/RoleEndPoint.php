<?php
namespace Api\Users;
use Core\Base\BaseApiEndpoint;

class RoleEndPoint extends BaseApiEndpoint
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