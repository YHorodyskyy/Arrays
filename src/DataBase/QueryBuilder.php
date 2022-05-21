<?php

namespace App\DataBase;

class QueryBuilder
{
    private const QUERY_TYPE_INSERT = "INSERT";
    private string $queryType;
    private string $tableName;
    private array $columns;
    private array $values;
    private \PDO $db;

    public function __construct()
    {
        $this->db = DatabaseGateway::getConnection();
    }

    public function execute(): void
    {
        try {
            $this->db
                ->prepare($this->getQueryString())
                ->execute($this->values);
        } catch (\Exception $e) {
            echo 'Failed to execute query. ', $e->getMessage(), "\n";
        }
    }

    public function insert(array $keyValues): QueryBuilder
    {
        $this->queryType = self::QUERY_TYPE_INSERT;
        foreach ($keyValues as $key => $value) {
            $this->columns[] = (string)$key;
            $this->values[] = $value;
        }
        return $this;
    }

    public function table(string $tableName): QueryBuilder
    {
        $this->tableName = htmlspecialchars($tableName);
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function getQueryString(): string
    {
        $queryString = "";
        if ($this->queryType === self::QUERY_TYPE_INSERT) {
            $queryString = "INSERT INTO " . $this->tableName;
            $queryString .= " (" . implode(", ", $this->columns) . ")";
            $queryString .= " VALUES (" . implode(", ", array_fill(0, count($this->columns), "?")) . ");";
        } else {
            throw new \Exception("Unknown query type: '$this->queryType'");
        }
        return $queryString;
    }
}