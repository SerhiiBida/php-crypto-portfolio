<?php

namespace App\database\tables;

use App\database\traits\ConnectTrait;


class Portfolios
{
    /**
     * Таблица 'users'
     */
    use ConnectTrait;

    public static string $table = '
        CREATE TABLE IF NOT EXISTS `portfolios` (
            `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            `user_id` INT NOT NULL,
            FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
        );
    ';

    public function add(string $name, int $userId): bool
    {
        try {
            $sql = 'INSERT INTO `portfolios` (`name`, `user_id`) VALUES (?, ?)';

            $sth = $this->pdo->prepare($sql);

            $sth->execute([$name, $userId]);

            return true;

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return false;
        }
    }

    public function updateName(int $id, string $name): bool
    {
        try {
            $sql = 'UPDATE `portfolios` SET `name` = ? WHERE `id` = ?';

            $sth = $this->pdo->prepare($sql);

            $sth->execute([$name, $id]);

            return true;

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            $sql = 'DELETE FROM `portfolios` WHERE `id` = ?';

            $sth = $this->pdo->prepare($sql);

            $sth->execute([$id]);

            return true;

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return false;
        }
    }

    public function getAllByUser(int $userId): ?array
    {
        try {
            $sql = 'SELECT * FROM `portfolios` WHERE `user_id` = ?';

            $sth = $this->pdo->prepare($sql);

            $sth->execute([$userId]);

            return $sth->FetchAll(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return null;
        }
    }

    // Принадлежит ли данная запись пользователю
    public function isRecordOwnedByUser(int $id, int $userId): ?bool
    {
        try {
            $sql = 'SELECT COUNT(*) FROM `portfolios` WHERE `id` = ? AND `user_id` = ?';

            $sth = $this->pdo->prepare($sql);

            $sth->execute([$id, $userId]);

            return !empty($sth->FetchAll(\PDO::FETCH_ASSOC));

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return null;
        }
    }
}
