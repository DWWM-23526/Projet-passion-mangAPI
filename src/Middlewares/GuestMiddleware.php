<?php

namespace middlewares;

use Core\Base\BaseMiddleware;
use Core\HTTPRequest;
use core\HTTPResponse;

class GuestMiddleware extends BaseMiddleware
{
    public function handle(HTTPRequest $request, HTTPResponse $response,)
    {

        $headers = $request->getHeaders();

        if (isset($headers['Authorization'])) {
            $response->abort('cannot acces whil connected', 401);
        } 
    }
}
