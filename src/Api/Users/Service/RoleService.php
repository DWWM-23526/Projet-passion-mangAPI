<?php
namespace Api\Users\Service;

use Api\Users\Repository\RoleRepository;
use Core\Base\BaseApiService;

class RoleService extends BaseApiService
{
  public function __construct()
  {
    parent::__construct(RoleRepository::class);
  }

}