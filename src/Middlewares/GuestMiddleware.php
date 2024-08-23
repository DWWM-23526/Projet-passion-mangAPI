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

        $headers = array_change_key_case($headers, CASE_LOWER);

        if (isset($headers['authorization'])) {
            $response->abort('cannot acces whil connected', 401);
        } 
    }
}
