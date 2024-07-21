<?php

namespace Api\EmailConfirm\Model;

class EmailConfirm
{
  public ?int $id_conf;
  public string $email;
  public int $cle;
  public string $date;

  public function __construct(array $data = [])
  {
    $this->id_conf = $data['id_conf'];
    $this->email = $data['email'];
    $this->cle = $data['cle'];
    $this->date = $data['date'];
  }

  public function toArray(): array
  {
    return [
      'id_conf' => $this->id_conf,
      'email' => $this->email,
      'cle' => $this->cle,
      'date'=> $this->date,
    ];
  }

  
}