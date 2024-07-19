<?php

namespace Core;

class HTTPRequest
{

    private static HTTPRequest | null $instance = null;

    private string $requestMethod;
    private string $uri;
    private array $headers;
    private array $body;

    public function __construct()
    {
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $this->headers = getallheaders();
        $this->body = $this->parseBody();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function parseBody()
    {
        $body = [];

        if ($this->requestMethod == 'POST' || $this->requestMethod == 'PUT' || $this->requestMethod == 'PATCH') {
            $body = filter_var_array(json_decode(file_get_contents('php://input'), true) ?? [], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        return $body;
    }

    public function getMethod(): string
    {
        return $this->requestMethod;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getBody(): array
    {
        return $this->body;
    }
}
