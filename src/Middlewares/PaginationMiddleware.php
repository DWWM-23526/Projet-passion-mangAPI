<?php

namespace Middlewares;

use Core\HTTPResponse;

class PaginationMiddleware
{
    public static function handle(array $data, int $totalItems, HTTPResponse $response,): array
    {
        $response::setHeader("X-Total-Count: $totalItems");

        return $data;
    }
}
