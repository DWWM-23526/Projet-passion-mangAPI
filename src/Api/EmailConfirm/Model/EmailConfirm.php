<?php

namespace Api\EmailConfirm\Model;

class EmailConfirm
{
  public ?int $id_conf;
  public string $email;
  public string $name;
  public string $date;

  public function __construct(array $data = [])
  {
    $this->id_conf = $data['id_conf'];
    $this->email = $data['email'];
    $this->name = $data['name'];
    $this->date = $data['date'];
  }

  public function toArray(): array
  {
    return [
      'id_conf' => $this->id_conf,
      'email' => $this->email,
      'name' => $this->name,
      'date' => $this->date,
    ];
  }
}
