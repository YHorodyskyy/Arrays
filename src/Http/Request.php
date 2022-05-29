<?php

namespace App\Http;

class Request
{
    private string $method;
    private array $request;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->request = $_REQUEST;
    }

    public function getRawInput(string $name, mixed $default = null): string|null
    {
        return $this->request[$name] ?? $default;
    }

    public function getMethod(): string
    {
        return $this->method;
    }
}