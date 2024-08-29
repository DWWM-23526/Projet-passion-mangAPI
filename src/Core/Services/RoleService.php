<?php
namespace Auth\Services;

use Auth\Repositories\RoleRepository;
use Api\Services\_BaseApiService;

class RoleService extends _BaseApiService
{
  public function __construct()
  {
    parent::__construct(RoleRepository::class);
  }

}