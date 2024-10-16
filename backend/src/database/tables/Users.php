<?php

namespace App\database\tables;

use App\database\traits\ConnectTrait;


class Users
{
    /**
     * Таблица 'users'
     */
    use ConnectTrait;

    public static string $table = '
        CREATE TABLE IF NOT EXISTS `users` (
            `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `username` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `birthday` DATE NOT NULL,
            `salary` FLOAT NOT NULL,
            `years_experience` INT NOT NULL,
            `country_id` INT NOT NULL,
            `gender` VARCHAR(255) NOT NULL,
            `profile_picture` BLOB NOT NULL,
            FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`)
        );
    ';

    function searchByUsername($username): ?array
    {
        try {
            $sql = 'SELECT `username` FROM `interests` WHERE `username` = :username';

            $sth = $this->pdo->prepare($sql);

            $sth->execute(['username' => $username]);

            // FETCH_ASSOC - вернуть как вложенные ассоциативные массивы
            return $sth->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return null;
        }
    }
}
