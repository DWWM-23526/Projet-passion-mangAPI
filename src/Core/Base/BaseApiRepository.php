<?php

namespace Core\Base;

use Core\ORM\BaseRepository;

class BaseApiRepository extends BaseRepository
{

    public function getAllItems()
    {
        return $this->getAll($this->table);
    }

    public function getItemById(int $id)
    {
        return $this->getById($id);
    }

    public function searchItemsByName(array $searchTerm, array $columns)
    {
        return $this->search($searchTerm, $columns);
    }

    public function createItem(array $data)
    {
        return $this->create($data);
    }

    public function updateItem(array $data, int $id)
    {
        return $this->update($data, $id);
    }

    public function deleteItem(int $id)
    {
        return $this->delete($id, $this->primaryKey);
    }
}
