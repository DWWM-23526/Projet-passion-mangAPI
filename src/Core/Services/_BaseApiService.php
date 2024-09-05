<?php

namespace Core\Services;

use Api\Handler\PaginationHandler;
use Core\App;
use core\HTTPResponse;
use Core\repositories\_BaseApiRepository;
use Core\Validation\_BaseApiValidator;

abstract class _BaseApiService extends _BaseService
{
    protected $repository;
    protected $validator;

    protected function __construct($repository, $validator)
    {
        $this->repository = App::injectRepository()->getContainer($repository);
        $this->validator = App::injectValidator()->getContainer($validator);
    }

    public function getAll(HTTPResponse $response, $params)
    {

        try {
            $page = isset($params['_page']) ? (int)$params['_page'] : 1;
            $limit = isset($params['_limit']) ? (int)$params['_limit'] : 10000;
            $sortColumn = isset($params['_sort']) ? $params['_sort'] : null;
            $sortOrder = isset($params['_order']) ? $params['_order'] : 'ASC';
            $offset = ($page - 1) * $limit;

            $data = $this->repository->getAllItems($sortColumn, $sortOrder, $limit, $offset);
            $totalItems = $this->repository->getTotalItemCount();

            return PaginationHandler::addTotalCountHeader($data, $totalItems, $response);
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
        $this->validator->validateGet(['id' => $id]);
        return $this->repository->getItemById($id);
    }

    public function getMany(HTTPResponse $response, string $values)
    {


        $decodedFilter = json_decode($values, true);

        if (json_last_error() === JSON_ERROR_NONE && isset($decodedFilter['ids'])) {
            $values = $decodedFilter['ids'];
        }

        foreach ($values as $key => $value) {
            $this->validator->validateGet(['id' => $value]);
        };

        $data = $this->repository->getManyItems($values);

        return $data;
    }

    public function create(array $data)
    {

        $this->validator->validateCreate($data);

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
