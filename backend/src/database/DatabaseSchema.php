<?php

namespace App\database;

use App\database\tables\CoinPortfolio;
use App\database\tables\Coins;
use App\database\tables\Countries;
use App\database\tables\Interests;
use App\database\tables\Languages;
use App\database\tables\Portfolios;
use App\database\tables\UserInterest;
use App\database\tables\UserLanguage;
use App\database\tables\Users;
use App\database\traits\ConnectTrait;

class DatabaseSchema
{
    /**
     * Создание структуры базы данных
     */
    use ConnectTrait {
        ConnectTrait::__construct as __constructConnectTrait;
    }

    private array $tables;

    function __construct()
    {
        $this->tables = [
            Countries::$table,
            Users::$table,
            Languages::$table,
            UserLanguage::$table,
            Interests::$table,
            UserInterest::$table,
            Coins::$table,
            Portfolios::$table,
            CoinPortfolio::$table,
        ];

        // Запуск конструктора ConnectTrait
        $this->__constructConnectTrait();
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

        } catch (\PDOException $e) {
            // Откат
            $this->pdo->rollBack();

            die("Ошибка при создание структуры таблиц" . $e->getMessage() . "\n");
        }
    }
}

//$dbSchema = new DatabaseSchema();
//$dbSchema->createTables();