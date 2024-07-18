<?php

namespace Users\Model;

class Users
{
  public ?int $Id_user;
  public ?string $password;
  public ?string $email;
  public ?string $name;
  public int $is_deleted;


  public function __construct(array $data = [])
  {
    $this->Id_user = $data['Id_user'];
    $this->password = $data['password'];
    $this->email = $data['email'];
    $this->name = $data['name'];
    $this->is_deleted = $data['is_deleted'];
  }

  public function toArray(){
    return [
      'Id_user' => $this->Id_user,
      'password' => $this->password,
      'email' => $this->email,
      'name' => $this->name,
      'is_deleted' => $this->is_deleted
    ];
  }
}
