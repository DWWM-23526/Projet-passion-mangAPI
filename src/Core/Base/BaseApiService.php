<?php

namespace Core\Base;

use Core\App;

class BaseApiService
{
    protected $repository;

    protected function __construct($repository)
    {
        $this->repository = App::injectRepository()->getContainer($repository);
    }

    public function getAll()
    {
        return $this->repository->getAllItems();
    }

    public function getById(int $id)
    {
        return $this->repository->getItemById($id);
    }

    public function create(array $data)
    {
        return $this->repository->createItem($data);
    }

    public function update(array $data, int $id)
    {
        return $this->repository->updateItem($data, $id);
    }

    public function delete(int $id)
    {
        return $this->repository->deleteItem($id);
    }
}