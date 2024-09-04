<?php

namespace Api\Models;

class Tags
{
  public ?int $id;
  public ?string $tag_name;
  public string $img_tag;
  public bool $is_deleted;


  public function __construct(array $data = [])
  {
    $this->id = $data["Id_tag"] ?? null;
    $this->tag_name = $data["tag_name"] ?? '';
    $this->img_tag = $data["img_tag"] ?? '';
    $this->is_deleted = $data["is_deleted"] ?? 0;
  }

  public function toArray(): array
  {
    return [
      'Id_tag' => $this->id,
      'tag_name' => $this->tag_name,
      'img_tag' => $this->img_tag,
      'is_deleted' => $this->is_deleted
    ];
  }
}
