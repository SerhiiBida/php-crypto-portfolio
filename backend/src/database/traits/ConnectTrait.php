<?php

namespace App\database\traits;


trait ConnectTrait
{
    /**
     * Подключение к БД
     */
    private $pdo;

    public function __construct()
    {
        $this->connect();
    }

    function connect(): void
    {
        $dbHost = getenv('DB_HOST_NETWORK');
        $dbName = getenv('DB_NAME');
        $dbUser = getenv('DB_USER');
        $dbPassword = getenv('DB_PASS');

        try {
            $this->pdo = new \PDO(
                "mysql:host=$dbHost;dbname=$dbName;charset=utf8",
                $dbUser,
                $dbPassword
            );
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}