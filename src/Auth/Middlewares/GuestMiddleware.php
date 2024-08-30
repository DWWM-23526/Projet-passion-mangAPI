<?php

namespace Auth\Middlewares;

use Core\middlewares\_BaseMiddleware;
use Core\HTTPRequest;
use core\HTTPResponse;

class GuestMiddleware extends _BaseMiddleware
{
    public function handle(HTTPRequest $request, HTTPResponse $response,)
    {

        $headers = $request->getHeaders();

        $headers = array_change_key_case($headers, CASE_LOWER);

        if (isset($headers['authorization'])) {
            $response->abort('cannot access while connected', 401);
        } 
    }
}
