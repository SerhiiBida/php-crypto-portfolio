<?php

namespace App\database\tables;

use App\database\interfaces\TableInterface;
use App\database\traits\ConnectTrait;


class Countries implements TableInterface
{
    /**
     * Таблица 'countries'
     */
    use ConnectTrait;

    public static string $table = '
        CREATE TABLE IF NOT EXISTS `countries` (
            `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL
        );
    ';

    public function getAll(): ?array
    {
        try {
            $sql = 'SELECT * FROM `countries`';

            $stmt = $this->pdo->query($sql);

            // FETCH_ASSOC - вернуть как вложенные ассоциативные массивы
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return null;
        }
    }
}
