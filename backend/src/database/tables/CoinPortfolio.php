<?php

namespace App\database\tables;

use App\database\traits\ConnectTrait;
use App\database\tables\utils\CoinPortfolioUtils;


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

    // Получить все монеты в портфеле обычно или по фильтрации
    public function getCoinsForPortfolio(
        int    $portfolioId,
        int    $userId,
        string $searchName = null,
        int    $sort = null,
        int    $filterByPrice = null,
        int    $limit = null,
        int    $offset = null
    ): ?array
    {
        try {
            $sql = '
                SELECT `coins`.`name`, `coins`.`symbol`, `coins`.`price`,
                       (`coins`.`price` * SUM(`coins_amount`)) as real_price_investment,
                       SUM(`coins_amount`) as amount,
                       AVG(`money` / `coins_amount`) as average_buy_price,
                       (((`coins`.`price` * SUM(`coins_amount`)) - SUM(`money`))) as profit,
                       SUM(`money`) as investment
                FROM `coin_portfolio`
                    INNER JOIN `portfolios` ON `coin_portfolio`.`portfolio_id` = `portfolios`.`id`
                    INNER JOIN `coins` ON `coin_portfolio`.`coin_id` = `coins`.`id`
                WHERE `portfolio_id` = :portfolioId AND `portfolios`.`user_id` = :userId
                GROUP BY `coins`.`id`
            ';


            // Куча кода...

            $sth = $this->pdo->prepare($sql);

            // В новый массив положить параметры не равные null и запихнуть его в execute()
            $sth->execute([$portfolioId, $userId]);

            // FETCH_ASSOC - вернуть как ассоциативные массивы
            return $sth->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return null;
        }
    }
}
