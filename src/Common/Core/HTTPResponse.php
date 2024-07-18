<?php

namespace Common\core;

class HTTPResponse
{
    private static ?HTTPResponse $instance = null;

    public static function getInstance(): HTTPResponse
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function abort(int $error = 404): void
    {
        self::setStatusCode($error);
        self::setHeader('Content-Type: application/json');
        $message = ["error" => "Error $error: The requested resource could not be found."];
        echo json_encode($message);
        die();
    }

    public static function redirect(string $path, int $statusCode = 302): void
    {
        http_response_code($statusCode);
        header("Location: $path");
        die();
    }

    public static function setStatusCode(int $code, string $message = ''): void
    {
        http_response_code($code);
        if ($message) {
            header("Status: $message", true, $code);
        }
    }

    public static function setHeader(string $header): void
    {
        header($header);
    }

    public function sendJsonResponse(mixed $data, int $statusCode = 200): void
    {
        self::setStatusCode($statusCode);
        self::setHeader('Content-Type: application/json');
        echo json_encode($data);
        die();
    }

    public function sendTextResponse(string $text, int $statusCode = 200): void
    {
        self::setStatusCode($statusCode);
        self::setHeader('Content-Type: text/plain');
        echo $text;
        die();
    }

    public function sendHtmlResponse(string $html, int $statusCode = 200): void
    {
        self::setStatusCode($statusCode);
        self::setHeader('Content-Type: text/html');
        echo $html;
        die();
    }
}