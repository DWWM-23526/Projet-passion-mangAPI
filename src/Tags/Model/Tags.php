<?php

namespace Tags\Model;

class Tags
{
  public ?int $Id_tag;
  public ?string $tag_name;
  public bool $is_deleted;


  public function __construct(array $data = [])
  {
    $this->Id_tag = $data["Id_tag"];
    $this->tag_name = $data["tag_name"] ?? '';
    $this->is_deleted = $data["is_deleted"] ?? 0;
  }

  public function toArray():array{
    return [
      'Id_tag' => $this->Id_tag,
      'tag_name' => $this ->tag_name,
      'is_deleted'=> $this->is_deleted
    ];
  }
}