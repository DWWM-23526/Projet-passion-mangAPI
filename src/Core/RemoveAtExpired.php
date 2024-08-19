<?php

namespace Core;
use Core\ORM\BaseRepository;

class RemoveAtExpired extends BaseRepository
{
  public function deleteWhenExpiredEmailConfirm()
  {
    return $this->deleteWhenExpired();
  }
}