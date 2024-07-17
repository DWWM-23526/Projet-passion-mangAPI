<?php

namespace Manga\Model;

class Manga
{
  public int $Id_manga;
  public string $img_manga;
  public ?string $manga_name;
  public ?string $edition;
  public ?string $total_tome_number;
  public ?string $year_release;
  public ?int $tome_number;
  public ?string $texte;
  public int $Id_mangaka;
  public bool $is_deleted;


  public function __construct(array $data = [])
  {
    $this->Id_manga = $data["Id_manga"] ?? 0;
    $this->img_manga = $data['img_manga'] ?? '';
    $this->manga_name = $data['manga_name'] ?? null;
    $this->edition = $data['edition'] ?? null;
    $this->total_tome_number = $data['total_tome_number'] ?? null;
    $this->year_release = $data['year_release'] ?? null;
    $this->tome_number = $data['tome_number'] ?? null;
    $this->texte = $data['texte'] ?? null;
    $this->Id_mangaka = $data['Id_mangaka'] ?? 0;
    $this->is_deleted = $data['id_deleted'] ?? 0;
  }

  public function toArray(): array
    {
        return [
            'Id_manga' => $this->Id_manga,
            'img_manga' => $this->img_manga,
            'manga_name' => $this->manga_name,
            'edition' => $this->edition,
            'total_tome_number' => $this->total_tome_number,
            'year_release' => $this->year_release,
            'tome_number' => $this->tome_number,
            'texte' => $this->texte,
            'Id_mangaka' => $this->Id_mangaka,
            'is_deleted'=> $this->is_deleted
        ];
    }
}
