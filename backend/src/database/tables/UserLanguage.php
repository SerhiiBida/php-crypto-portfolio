<?php

namespace App\database\tables;


use App\database\traits\ConnectTrait;

class UserLanguage
{
    /**
     * Таблица 'user_language'
     */
    use ConnectTrait;

    public static string $table = '
        CREATE TABLE IF NOT EXISTS `user_language` (
            `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `user_id` INT NOT NULL,
            `language_id` INT NOT NULL,
            FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
            FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`)
        );
    ';

    public function add($userId, $languageId): bool
    {
        try {
            $sql = 'INSERT INTO `user_language` (`user_id`, `language_id`) VALUES (?, ?)';

            $sth = $this->pdo->prepare($sql);

            $sth->execute([$userId, $languageId]);

            return true;

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return false;
        }
    }

    // Добавления много записей для одного user
    public function addRecordsForUser(int $userId, array $languageIds): bool
    {
        try {
            $this->pdo->beginTransaction();

            foreach ($languageIds as $languageId) {
                $check = $this->add($userId, $languageId);

                if (!$check) {
                    $this->pdo->rollBack();

                    return false;
                }
            }

            $this->pdo->commit();

        } catch (\PDOException $e) {
            $this->pdo->rollBack();

            echo 'Error: ' . $e->getMessage();

            return false;
        }

        return true;
    }
}