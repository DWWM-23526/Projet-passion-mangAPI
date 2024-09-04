<?php

namespace Api\Handler;

use Core\HTTPResponse;

class PaginationHandler
{
    public static function addTotalCountHeader(array $data, int $totalItems, HTTPResponse $response,): array
    {
        $response::setHeader("X-Total-Count: $totalItems");

        return $data;
    }
}
