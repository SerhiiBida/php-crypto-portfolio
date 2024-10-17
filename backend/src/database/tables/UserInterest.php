<?php

namespace App\database\tables;


use App\database\traits\ConnectTrait;

class UserInterest
{
    /**
     * Таблица 'user_interest'
     */
    use ConnectTrait;

    public static string $table = '
        CREATE TABLE IF NOT EXISTS `user_interest` (
            `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `user_id` INT NOT NULL,
            `interest_id` INT NOT NULL,
            FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
            FOREIGN KEY (`interest_id`) REFERENCES `interests` (`id`)
        );
    ';

    public function add($userId, $interestId): bool
    {
        try {
            $sql = 'INSERT INTO `user_interest` (`user_id`, `interest_id`) VALUES (?, ?)';

            $sth = $this->pdo->prepare($sql);

            $sth->execute([$userId, $interestId]);

            return true;

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return false;
        }
    }

    // Добавления много записей для одного user
    public function addRecordsForUser(int $userId, array $interestIds): bool
    {
        try {
            $this->pdo->beginTransaction();

            foreach ($interestIds as $interestId) {
                $check = $this->add($userId, $interestId);

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
