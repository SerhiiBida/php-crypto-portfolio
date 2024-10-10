<?php

class DatabaseSchema
{
    /**
     * Структура базы данных
     */
    private string $host;
    private string $db;
    private string $user;
    private string $pass;
    private $pdo;

    private array $tables = [
        'CREATE TABLE IF NOT EXISTS `users` (
            `id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
            `username` VARCHAR(255) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `birthday` DATE NOT NULL
        )'
    ];

    function __construct()
    {
        $this->host = getenv('DB_HOST_NETWORK');
        $this->db = getenv('DB_NAME');
        $this->user = getenv('DB_USER');
        $this->pass = getenv('DB_PASS');

        $this->connect();
    }

    // Подключение к БД
    function connect(): void
    {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->db;charset=utf8", $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Создание таблиц через транзакцию(в одном запросе ошибка - откат всех)
    function createTables(): void
    {
        try {
            $this->pdo->beginTransaction();

            foreach ($this->tables as $table) {
                $this->pdo->exec($table);
            }

            $this->pdo->commit();

        } catch (PDOException $e) {
            // Откат
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }

            echo "Ошибка при создание структуры таблиц" . $e->getMessage() . "\n";
        }
    }
}

//$dbSchema = new DatabaseSchema();
//$dbSchema->createTables();