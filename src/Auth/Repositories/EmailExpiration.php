<?php

namespace Auth\Repositories;

use Core\Repositories\_BaseRepository;

class EmailExpiration extends _BaseRepository
{
  public function deleteWhenExpiredEmailConfirm()
  {
    return $this->deleteWhenExpired();
  }
}