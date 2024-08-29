<?php

namespace Auth\Models;

class Role
{
  public int $id;
  public string $nom;
  public int $role_weight;

  public function __construct(array $data = [])
  {
    $this->id = $data['id_role'];
    $this->nom = $data['nom'];
    $this->role_weight = $data['role_weight'];
  }

  public function toArray()
  {
    return [
      'id_role' => $this->id,
      'nom' => $this->nom,
      'role_weight' => $this->role_weight
    ];
  }
}
