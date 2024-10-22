<?php

namespace App\database\tables;

use App\database\traits\ConnectTrait;


class CoinPortfolio
{
    /**
     * Таблица 'coin_portfolio'
     */
    use ConnectTrait;

    public static string $table = '
        CREATE TABLE IF NOT EXISTS `coin_portfolio` (
            `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `coin_id` INT NOT NULL,
            `portfolio_id` INT NOT NULL,
            `coins_amount` DECIMAL(20,10) NOT NULL,
            `money` DECIMAL(20,10) NOT NULL,
            `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`coin_id`) REFERENCES `coins` (`id`),
            FOREIGN KEY (`portfolio_id`) REFERENCES `portfolios` (`id`)
        );
    ';

    public function add(int $coinId, int $portfolioId, string $coinsAmount, string $money): bool
    {
        try {
            $sql = '
                INSERT INTO `coin_portfolio` (`coin_id`, `portfolio_id`, `coins_amount`, `money`)
                VALUES (?, ?, ?, ?);
            ';

            $sth = $this->pdo->prepare($sql);

            $sth->execute([$coinId, $portfolioId, $coinsAmount, $money]);

            return true;

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return false;
        }
    }
}
