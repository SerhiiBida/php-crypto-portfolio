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

    public function add(string $name, int $user_id): bool
    {
        try {
            $sql = 'INSERT INTO `portfolios` (`name`, `user_id`) VALUES (?, ?)';

            $sth = $this->pdo->prepare($sql);

            $sth->execute([$name, $user_id]);

            return true;

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return false;
        }
    }
}
