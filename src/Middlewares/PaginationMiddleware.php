<?php

namespace Middlewares;

use Core\HTTPResponse;

class PaginationMiddleware
{
    public static function handle(array $data, HTTPResponse $response,): array
    {
        $totalItems = count($data);
       
        $response::setHeader("X-Total-Count: $totalItems");

        return $data;
    }
}