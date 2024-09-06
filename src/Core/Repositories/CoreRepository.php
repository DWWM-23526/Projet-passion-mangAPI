<?php

namespace Core\repositories;

use Core\Repositories\_BaseRepository;

class CoreRepository extends _BaseRepository
{

    public function checkIfItemExists(string $table, array $values, array $columns)
    {
        return $this->checkIfExists($table, $values, $columns);
    }
   
}
