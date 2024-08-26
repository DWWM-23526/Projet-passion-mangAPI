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

    public function getAll(HTTPResponse $response, $params)
    {

        try {
            $page = isset($params['_page']) ? (int)$params['_page'] : 1;
            $limit = isset($params['_limit']) ? (int)$params['_limit'] : 25;
            $sortColumn = isset($params['_sort']) ? $params['_sort'] : null;
            $sortOrder = isset($params['_order']) ? $params['_order'] : 'ASC';
            $offset = ($page - 1) * $limit;

            $data = $this->repository->getAllItems($sortColumn, $sortOrder, $limit, $offset);
            $totalItems = $this->repository->getTotalItemCount();

            return PaginationMiddleware::handle($data, $totalItems, $response);
            
        } catch (\PDOException $pdoEx) {

            throw new \PDOException('Failed to retrieve data due to a database error');
        } catch (\InvalidArgumentException $invalidArgEx) {

            throw new \InvalidArgumentException('Invalid parameters provided');
        } catch (\Throwable $th) {

            throw new \Throwable('An unexpected error occurred');
        }
    }

    public function getById(int $id)
    {
        return $this->repository->getItemById($id);
    }

    public function getMany(HTTPResponse $response, string $values)
    {

        try {
            $decodedFilter = json_decode($values, true);

            if (json_last_error() === JSON_ERROR_NONE && isset($decodedFilter['ids'])) {
                $values = $decodedFilter['ids'];
            }

            $data = $this->repository->getManyItems($values);

            return $data;

        } catch (\PDOException $pdoEx) {

            throw new \PDOException('Failed to retrieve data due to a database error');
        } catch (\InvalidArgumentException $invalidArgEx) {

            throw new \InvalidArgumentException('Invalid parameters provided');
        } catch (\Throwable $th) {

            throw new \Throwable('An unexpected error occurred');
        }
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
