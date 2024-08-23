<?php

namespace Core\Base;

use core\HTTPResponse;

class BaseController
{


    protected function sendSuccessResponse(HTTPResponse $response, $data, $message = '')
    {
        $response->sendJsonResponse([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ]);
    }

    protected function sendErrorResponse(HTTPResponse $response, $message = '', $code = 500)
    {
        $response->sendJsonResponse([
            'success' => false,
            'message' => $message,
        ], $code);
    }

    protected function abortResponse(HTTPResponse $response, $message = 'An error occurred', $code = 500)
    {
        $response->abort($message, $code);
    }
}
