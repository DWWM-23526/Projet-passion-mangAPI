<?php

namespace core;

class HTTPResponse
{

    public static function abort(int $error = 404)
    {
        http_response_code($error);
        $path = __DIR__ . "/../views/errors/{$error}.php";

        if (file_exists($path)) {
            require_once $path;
        } else {
            echo "Error $error: The requested resource could not be found.";
        }

        die();
    }

    public static function redirect(string $path, int $statusCode)
    {
        http_response_code($statusCode);
        header("Location: $path");
        // HTTPResponse::setHeader('Auth: heheh');
        die();
    }

    public static function setStatusCode(int $code, string $message = '')
    {
        http_response_code($code);
        if ($message) {
            header("Status: $message", true, $code);
        }
    }

    public static function setHeader(string $header)
    {
        header($header);
    }
}