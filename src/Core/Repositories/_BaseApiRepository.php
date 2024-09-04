<?php

namespace Core\repositories;

use Core\Repositories\_BaseRepository;

abstract class _BaseApiRepository extends _BaseRepository
{

    public function getAllItems(string $sortColumn = null, string $sortOrder, int $limit, int $offset)
    {
        return $this->getAll($this->table, $sortColumn, $sortOrder, $limit, $offset);
    }

    public function getTotalItemCount(): int
    {
        return $this->getTotalCount($this->table);
    }

    public function getItemById(int $id)
    {
        return $this->getById($id);
    }

    public function getManyItems(array $values)
    {
        return $this->getMany($values);
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
