<?php

namespace Core\Base;

use Core\App;
use core\HTTPResponse;
use Middlewares\PaginationMiddleware;

abstract class BaseApiService
{
    protected $repository;

    protected function __construct($repository)
    {
        $this->repository = App::injectRepository()->getContainer($repository);
    }

    public function getAll(HTTPResponse $response, int $perPage = 25)
    {
        $data = $this->repository->getAllItems();

        return PaginationMiddleware::apply($data, $response, $perPage);
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
