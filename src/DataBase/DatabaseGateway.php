<?php

namespace App\DataBase;

class DatabaseGateway
{
    private static \PDO $db;

    public static function getConnection(array $config): \PDO
    {
        if (!isset(static::$db)) {
            static::connect($config);
        }
        return static::$db;
    }

    private static function connect(array $config): void
    {
        try {
            static::$db = new \PDO(
                $config["driver"] . ":host=" . $config["host"] . ";dbname=" . $config["database"],
                $config["user"],
                $config["pass"]
            );
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), $e->getCode());
        }
    }
}