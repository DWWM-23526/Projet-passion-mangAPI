<?php

namespace Mangaka\Model;

class Mangaka
{
  public int $Id_mangaka;
  public string $img_mangaka;
  public ?string $first_name;
  public ?string $last_name;
  public ?string $birthdate;
  public ?string $texte;
  public bool $is_deleted;

  public function __construct(array $data = [])
  {
    $this->Id_mangaka = $data['Id_mangaka'] ?? 0;
    $this->img_mangaka = $data['img_mangaka'] ?? '';
    $this->first_name = $data['first_name'] ?? null;
    $this->last_name = $data['last_name'] ?? null;
    $this->birthdate = $data['birthdate'] ?? null;
    $this->texte = $data['texte'] ?? null;
    $this->is_deleted = $data['id_deleted'] ?? 0;
  }
}
