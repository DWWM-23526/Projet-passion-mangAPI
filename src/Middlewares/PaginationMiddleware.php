<?php

namespace Middlewares;

use Core\HTTPResponse;

class PaginationMiddleware
{
    public static function apply(array $data, HTTPResponse $response, int $perPage = 25): array
    {
        $totalItems = count($data);
        $rangeStart = 0;
        $rangeEnd = $totalItems > $perPage ? $perPage - 1 : $totalItems - 1;

        $response::setHeader("Content-Range: items $rangeStart-$rangeEnd/$totalItems");
        $response::setHeader("Access-Control-Expose-Headers: Content-Range");

        return array_slice($data, $rangeStart, $perPage);
    }
}