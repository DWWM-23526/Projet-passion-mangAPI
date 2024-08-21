<?php

namespace Api\Users\Model;

class Users
{
  public int $id;
  public string $name;
  public string $email;
  public string $password;
  public ?int $is_deleted;
  public int $id_role;

  public function __construct(array $data = [])
  {
    $this->id = $data['Id_user'];
    $this->name = $data['name'] ?? '';
    $this->email = $data['email'] ?? '';
    $this->password = $data['password'] ?? "";
    $this->is_deleted = $data['is_deleted'] ?? 0;
    $this->id_role = $data['id_role'] ?? 1;
  }

  public function toArray()
  {
    return [
      'Id_user' => $this->id,
      'name' => $this->name,
      'email' => $this->email,
      'password' => $this->password,
      'is_deleted' => $this->is_deleted,
      'id_role' => $this->id_role
    ];
  }
}
