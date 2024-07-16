<?php

namespace Tags\Model;

class Tags
{
  public int $Id_tag;
  public ?string $tag_name;

  public function __construct(array $data = [])
  {
    $this->Id_tag = $data["Id_tag"];
    $this->tag_name = $data["tag_name"];
  }
}