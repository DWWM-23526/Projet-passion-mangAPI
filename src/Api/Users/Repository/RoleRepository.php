<?php
namespace Api\Users\Repository;

use Api\Users\Model\Role;
use Core\Base\BaseApiRepository;

class RoleRepository extends BaseApiRepository
{
  protected $table = 'role';
  protected $modelClass = Role::class;
  protected $primaryKey = 'id_role';
}