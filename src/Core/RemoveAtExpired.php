<?php

namespace Core;
use Core\Base\BaseRepository;

class RemoveAtExpired extends BaseRepository
{
  public function deleteWhenExpiredEmailConfirm()
  {
    return $this->deleteWhenExpired();
  }
}