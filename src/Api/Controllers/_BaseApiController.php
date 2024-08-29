<?php

namespace Api\Controllers;

use Core\App;
use Core\Controllers\_BaseController;
use Core\HTTPRequest;
use Core\HTTPResponse;

abstract class _BaseApiController extends _BaseController
{
    protected  $service;

    protected function __construct($service)
    {
        $this->service = App::injectService()->getContainer($service);
    }

    public function get(HTTPRequest $request, HTTPResponse $response)
    {
        $values = isset($_GET['filter']) ? $_GET['filter'] : null;
        $params = $_GET ?? null;

        if ($values) {

            return $this->getFiltered($response, $values);
        } else {

            return $this->getAllResources($response, $params);
        }
    }

    protected function getFiltered(HTTPResponse $response, $values)
    {
        try {
            $data = $this->service->getMany($response, $values);
            $this->sendSuccessResponse($response, $data);
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, 'Failed to fetch data', 404);
        }
    }

    protected function getAllResources(HTTPResponse $response, $params)
    {
        try {
            $data = $this->service->getAll($response, $params);
            $this->sendSuccessResponse($response, $data);
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, 'Failed to fetch all data', 404);
        }
    }

    public function getById(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $id = $params['id'];
        try {
            $data = $this->service->getById($id);
            $this->sendSuccessResponse($response, $data);
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, 'Failed to fetch data', 404);
        }
    }

    public function create(HTTPRequest $request, HTTPResponse $response)
    {
        $body = $request->getBody();
        try {
            $data = $this->service->create($body);
            $this->sendSuccessResponse($response,  $data, 'Resource created successfully');
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, 'Failed to create resource', 500);
        }
    }

    public function update(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $id = $params['id'];
        $body = $request->getBody();
        try {
            $data = $this->service->update($body, $id);
            $this->sendSuccessResponse($response, $data, 'Resource updated successfully');
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, 'Failed to update resource ', 500);
        }
    }

    public function delete(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $id = $params['id'];

        if (strpos($id, ',') !== false) {
            return $this->deleteMultiple($request, $response, explode(',', $id));
        }

        return $this->deleteSingle($request, $response, $id);
    }

    protected function deleteSingle(HTTPRequest $request, HTTPResponse $response, $id)
    {
        try {
            $this->service->delete(trim($id));
            $this->sendSuccessResponse($response, [], 'Resource deleted successfully');
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, 'Failed to delete resource: ' . $th->getMessage());
        }
    }

    protected function deleteMultiple(HTTPRequest $request, HTTPResponse $response, array $ids)
    {
        try {
            foreach ($ids as $singleId) {
                $this->service->delete(trim($singleId));
            }
            $this->sendSuccessResponse($response, [], 'Resources deleted successfully');
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, 'Failed to delete resources: ' . $th->getMessage());
        }
    }
}
