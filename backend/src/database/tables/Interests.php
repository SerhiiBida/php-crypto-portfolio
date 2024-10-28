<?php

namespace App\database\tables;

use App\database\interfaces\TableInterface;
use App\database\traits\ConnectTrait;


class Interests implements TableInterface
{
    /**
     * Таблица 'interests'
     */
    use ConnectTrait;

    public static string $table = '
        CREATE TABLE IF NOT EXISTS `interests` (
            `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL
        );
    ';

    public function getAll(): ?array
    {
        try {
            $sql = 'SELECT * FROM `interests`';

            $stmt = $this->pdo->query($sql);

            // FETCH_ASSOC - вернуть как вложенные ассоциативные массивы
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return null;
        }
    }

    public function getAllIds(): ?array
    {
        try {
            $sql = 'SELECT `id` FROM `interests`';

            $stmt = $this->pdo->query($sql);

            // FETCH_ASSOC - вернуть как ассоциативный массив
            return $stmt->fetchAll(\PDO::FETCH_COLUMN);

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return null;
        }
    }

    public function getExistingIds(array $ids): ?array
    {
        try {
            // Количество данных для вставки
            $inQuery = str_repeat('?,', count($ids) - 1) . '?';

            $sql = "SELECT `id` FROM `interests` WHERE `id` IN ($inQuery)";

            $sth = $this->pdo->prepare($sql);

            $sth->execute($ids);

            // FETCH_COLUMN - вернуть данные одного столбца в виде массива
            return $sth->fetchAll(\PDO::FETCH_COLUMN);

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return null;
        }
    }
}