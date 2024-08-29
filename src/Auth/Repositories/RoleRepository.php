<?php
namespace Auth\Repositories;

use Core\repositories\_BaseApiRepository;
use Auth\Models\Role;

class RoleRepository extends _BaseApiRepository
{
  protected $table = 'role';
  protected $modelClass = Role::class;
  protected $primaryKey = 'id_role';
}