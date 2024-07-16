<?php

namespace Favorites\Model;

class Favories
{
  public int $Id_user;
  public int $Id_manga;


  public function __construct(array $data = [])
  {
    $this->Id_user = $data['Id_user'];
    $this->Id_manga = $data['Id_manga'];
  }
}