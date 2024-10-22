<?php

namespace App\database\tables;

use App\database\interfaces\TableInterface;
use App\database\traits\ConnectTrait;


class Coins implements TableInterface
{
    /**
     * Таблица 'coins'
     */
    use ConnectTrait;

    public static string $table = '
        CREATE TABLE IF NOT EXISTS `coins` (
            `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            `symbol` VARCHAR(255) NOT NULL,
            `price` DECIMAL(20,10) NOT NULL
        );
    ';

    public function getAll(): ?array
    {
        try {
            $sql = 'SELECT * FROM `coins`';

            $stmt = $this->pdo->query($sql);

            // FETCH_ASSOC - вернуть как ассоциативные массивы
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return null;
        }
    }

    public function existsById(int $id): ?bool
    {
        try {
            $sql = 'SELECT `id` FROM `coins` WHERE `id` = :id';

            $sth = $this->pdo->prepare($sql);

            $sth->execute(['id' => $id]);

            return !empty($sth->fetch(\PDO::FETCH_ASSOC));

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return null;
        }
    }
}
