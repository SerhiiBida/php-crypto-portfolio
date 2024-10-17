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
            `username` VARCHAR(255) NOT NULL UNIQUE,
            `email` VARCHAR(255) NOT NULL UNIQUE,
            `password` VARCHAR(255) NOT NULL,
            `birthday` DATE NOT NULL,
            `salary` FLOAT NOT NULL,
            `years_experience` INT NOT NULL,
            `country_id` INT NOT NULL,
            `gender` VARCHAR(255) NOT NULL,
            `profile_picture` LONGBLOB NOT NULL,
            FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`)
        );
    ';

    public function add(
        string $username,
        string $email,
        string $password,
        string $birthday,
        float  $salary,
        int    $yearsExperience,
        int    $countryId,
        string $gender,
        string $profilePicture
    ): ?int
    {
        try {
            $sql = 'INSERT INTO `users` (
                     `username`, `email`, `password`,
                    `birthday`, `salary`, `years_experience`,
                     `country_id`, `gender`, `profile_picture`
                     )
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';

            $sth = $this->pdo->prepare($sql);

            $sth->execute(
                [
                    $username, $email, $password,
                    $birthday, $salary, $yearsExperience,
                    $countryId, $gender, $profilePicture
                ]
            );

            // id последней вставленной записи
            return (int)$this->pdo->lastInsertId();

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return null;
        }
    }

    public function searchUsernames($username): ?array
    {
        try {
            $sql = 'SELECT `username` FROM `users` WHERE `username` = :username';

            $sth = $this->pdo->prepare($sql);

            $sth->execute(['username' => $username]);

            // FETCH_COLUMN - вернуть данные одного столбца в виде массива
            return $sth->fetchAll(\PDO::FETCH_COLUMN);

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return null;
        }
    }

    function searchEmails($email): ?array
    {
        try {
            $sql = 'SELECT `email` FROM `users` WHERE `email` = :email';

            $sth = $this->pdo->prepare($sql);

            $sth->execute(['email' => $email]);

            // FETCH_COLUMN - вернуть данные одного столбца в виде массива
            return $sth->fetchAll(\PDO::FETCH_COLUMN);

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return null;
        }
    }
}
