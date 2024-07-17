<?php

namespace Common\core;

class HTTPResponse
{
    private static HTTPResponse| null $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

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
    
    public function sendJsonResponse(array $data, int $statusCode = 200)
    {
        self::setStatusCode($statusCode);
        self::setHeader('Content-Type: application/json');
        echo json_encode($data);
        die();
    }
}