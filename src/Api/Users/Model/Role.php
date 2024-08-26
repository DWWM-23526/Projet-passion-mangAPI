<?php

namespace Api\Users\Model;

class Role
{
  public int $id;
  public string $nom;

  public function __construct(array $data = [])
  {
    $this->id = $data['id_role'];
    $this->nom = $data['nom'];
  }

  public function toArray()
  {
    return [
      'id_role' => $this->id,
      'nom' => $this->nom
    ];
  }
}
