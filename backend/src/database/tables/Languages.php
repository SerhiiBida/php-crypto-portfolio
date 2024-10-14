<?php

namespace App\database\tables;


use App\database\interfaces\TableInterface;
use App\database\traits\ConnectTrait;

class Languages implements TableInterface
{
    /**
     * Таблица 'languages'
     */
    use ConnectTrait;

    public static string $table = '
        CREATE TABLE IF NOT EXISTS `languages` (
            `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL
        );
    ';

    public function getAll(): ?array
    {
        try {
            $sql = 'SELECT * FROM `languages`';

            $stmt = $this->pdo->query($sql);

            // FETCH_ASSOC - вернуть как вложенные ассоциативные массивы
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return null;
        }
    }
}