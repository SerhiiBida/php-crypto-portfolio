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
            `token` VARCHAR(255) UNIQUE,
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

    public function getAllIds(): ?array
    {
        try {
            $sql = 'SELECT `id` FROM `users`';

            $stmt = $this->pdo->query($sql);

            // FETCH_ASSOC - вернуть как ассоциативный массив
            return $stmt->fetchAll(\PDO::FETCH_COLUMN);

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return null;
        }
    }

    public function getByUsername(string $username): ?array
    {
        try {
            $sql = 'SELECT * FROM `users` WHERE `username` = :username';

            $sth = $this->pdo->prepare($sql);

            $sth->execute(['username' => $username]);

            // FETCH_ASSOC - вернуть как ассоциативный массив
            return $sth->fetch(\PDO::FETCH_ASSOC);

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

    public function addToken(int $userId, string $token): bool
    {
        try {
            $sql = '
                UPDATE `users` SET `token` = :token WHERE `id` = :userId
            ';

            $sth = $this->pdo->prepare($sql);

            $sth->bindValue(':token', $token, \PDO::PARAM_STR);
            $sth->bindValue(':userId', $userId, \PDO::PARAM_INT);

            $sth->execute();

            return true;

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return false;
        }
    }

    public function isToken(string $token): bool
    {
        try {
            $sql = '
                SELECT `token` FROM `users` WHERE `token` = :token
            ';

            $sth = $this->pdo->prepare($sql);

            $sth->bindValue(':token', $token, \PDO::PARAM_STR);

            $sth->execute();

            return !empty($sth->fetch(\PDO::FETCH_ASSOC));

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return false;
        }
    }

    public function getUserForToken(string $token): ?array
    {
        try {
            $sql = '
                SELECT * FROM `users` WHERE `token` = :token
            ';

            $sth = $this->pdo->prepare($sql);

            $sth->bindValue(':token', $token, \PDO::PARAM_STR);

            $sth->execute();

            return $sth->fetch(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return null;
        }
    }
}
