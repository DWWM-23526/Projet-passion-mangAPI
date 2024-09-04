<?php
namespace Auth\Services;

use Auth\Repositories\RoleRepository;
use Auth\Validation\RoleValidator;
use Core\Services\_BaseApiService;

class RoleService extends _BaseApiService
{
  public function __construct()
  {
    parent::__construct(RoleRepository::class, RoleValidator::class);
  }

}