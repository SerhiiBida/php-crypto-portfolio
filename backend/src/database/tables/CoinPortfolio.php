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

    // Получить все монеты в портфеле(обычно или по фильтрации)
    public function getCoinsForPortfolio(
        int    $portfolioId,
        int    $userId,
        string $searchName = null,
        string $sort = null,
        string $filterByPrice = null,
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
            ';

            // Условие, фильтрация, поиск
            $sql .= ' WHERE `portfolio_id` = ? AND `portfolios`.`user_id` = ?'
                . CoinPortfolioUtils::getSqlFilter($filterByPrice)
                . CoinPortfolioUtils::getSqlSearch($searchName);

            // Группировка
            $sql .= ' GROUP BY `coins`.`id`';

            // Сортировка
            $sql .= CoinPortfolioUtils::getSqlSort($sort);

            // Ограничения
            $sql .= CoinPortfolioUtils::getSqlLimitAndOffset($limit, $offset);

            echo $sql . '<br>';
            echo $limit . '<br>';
            echo $offset . '<br>';

            $sth = $this->pdo->prepare($sql);

            // Получаем параметры для вставки
            $params = CoinPortfolioUtils::getParams([
                $portfolioId,
                $userId,
                $searchName,
                $limit,
                $offset
            ]);

            $sth->execute($params);

            // FETCH_ASSOC - вернуть как ассоциативные массивы
            return $sth->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return null;
        }
    }

    // Получить количество разных монет в портфеле(обычно или по фильтрации)
    public function getCountCoinsForPortfolio(
        int    $portfolioId,
        int    $userId,
        string $searchName = null,
        string $filterByPrice = null
    ): ?array
    {
        try {
            $additionalSql = '
                SELECT `coins`.`id`
                FROM `coin_portfolio`
                    INNER JOIN `portfolios` ON `coin_portfolio`.`portfolio_id` = `portfolios`.`id`
                    INNER JOIN `coins` ON `coin_portfolio`.`coin_id` = `coins`.`id`
            ';

            // Условие, фильтрация, поиск
            $additionalSql .= ' WHERE `portfolio_id` = ? AND `portfolios`.`user_id` = ?'
                . CoinPortfolioUtils::getSqlFilter($filterByPrice)
                . CoinPortfolioUtils::getSqlSearch($searchName);

            // Группировка
            $additionalSql .= ' GROUP BY `coins`.`id`';

            // Запрос
            $sql = "SELECT COUNT(*) FROM ($additionalSql) AS subquery";

            $sth = $this->pdo->prepare($sql);

            // Получаем параметры для вставки
            $params = CoinPortfolioUtils::getParams([
                $portfolioId,
                $userId,
                $searchName,
            ]);

            $sth->execute($params);

            // FETCH_ASSOC - вернуть значение одного столбца в виде массива
            return $sth->fetchAll(\PDO::FETCH_COLUMN);

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return null;
        }
    }
}
