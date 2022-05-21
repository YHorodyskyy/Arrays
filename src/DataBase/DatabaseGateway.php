<?php

namespace App\DataBase;

class DatabaseGateway
{
    private static \PDO $db;

    public static function getConnection(): \PDO
    {
        if (!isset(static::$db)) {
            static::connect();
        }
        return static::$db;
    }

    private static function connect(): void
    {
        $dsn = $_ENV['DATA_BASE_DSN'] ?? "mysql:host=" . $_ENV['DATA_BASE_HOST'] . ";dbname=" . $_ENV['DATA_BASE_NAME'];
        static::$db = new \PDO(
            $dsn,
            $_ENV['DATA_BASE_USER'],
            $_ENV['DATA_BASE_PASS']
        );
    }
}