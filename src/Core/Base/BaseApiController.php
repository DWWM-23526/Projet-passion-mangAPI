<?php

namespace Core\Base;

use Core\App;
use Core\HTTPRequest;
use Core\HTTPResponse;

abstract class BaseApiController extends BaseController
{
    protected  $service;

    protected function __construct($service)
    {
        $this->service = App::injectService()->getContainer($service);
    }

    public function get(HTTPRequest $request, HTTPResponse $response)
    {

        $values = isset($_GET['filter']) ? $_GET['filter'] : null;

        if ($values) {
            try {
                $data = $this->service->getMany($response, $values);
                $this->sendSuccessResponse($response, $data);
            } catch (\Throwable $th) {

                $this->sendErrorResponse($response, $th, 404);
            }
        } else {

            try {
                $data = $this->service->getAll($response);
                $this->sendSuccessResponse($response, $data);
            } catch (\Throwable $th) {

                $this->sendErrorResponse($response, 'Failed to fetch data', 404);
            }
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
            $this->sendErrorResponse($response, $th, 500);
        }
    }

    public function delete(HTTPRequest $request, HTTPResponse $response, $params)
    {
        $id = $params['id'];
        try {
            $this->service->delete($id);
            $this->sendSuccessResponse($response, [], 'Resource deleted successfully');
        } catch (\Throwable $th) {
            $this->sendErrorResponse($response, 'Failed to delete resource');
        }
    }
}
