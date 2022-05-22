<?php

namespace App;

/**
 * @property array|null $db
 */
class Config
{
    private static array $config = [];

    public function __construct()
    {
        if (empty(static::$config)) {
            $this->load();
        }
    }

    public function __get(string $name)
    {
        return static::$config[$name] ?? null;
    }

    private function load(): void
    {
        static::$config['db'] = [
            "driver" => $_ENV["DB_DRIVER"],
            "host" => $_ENV["DB_HOST"],
            "database" => $_ENV["DB_DATABASE"],
            "user" => $_ENV["DB_USER"],
            "pass" => $_ENV["DB_PASS"]
        ];
    }
}