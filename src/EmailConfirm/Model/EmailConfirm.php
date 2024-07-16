<?php

namespace EmailConfirm\Model;

class EmailConfirm
{
  public int $id_conf;
  public string $email;
  public int $cle;

  public function __construct(array $data = [])
  {
    $this->id_conf = $data['id_conf'];
    $this->email = $data['email'];
    $this->cle = $data['cle'];
  }
}
