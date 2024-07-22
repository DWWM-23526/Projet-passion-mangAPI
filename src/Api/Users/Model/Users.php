<?php

namespace Api\Users\Model;

class Users
{
  public ?int $Id_user;
  public ?string $name;
  public ?string $email;
  public ?string $password;
  public ?int $is_deleted;
  public function __construct(array $data = [])
  {
    $this->Id_user = $data['Id_user'];
    $this->name = $data['name'] ?? '';
    $this->email = $data['email'] ?? '';
    $this->password = $data['password'] ?? "";
    $this->is_deleted = $data['is_deleted'] ?? 0;
  }

  public function toArray()
  {
    return [
      'Id_user' => $this->Id_user,
      'name' => $this->name,
      'email' => $this->email,
      'password' => $this->password,
      'is_deleted' => $this->is_deleted
    ];
  }
}
