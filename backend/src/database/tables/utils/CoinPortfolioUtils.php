<?php

namespace App\database\tables\utils;


use App\database\tables\CoinPortfolio;

class CoinPortfolioUtils
{
    public static function getSqlFilter(string $filterByPrice = null): string
    {
        if (is_null($filterByPrice)) {
            return '';
        }

        return match ($filterByPrice) {
            '0-99' => ' AND `coins`.`price` BETWEEN 0 AND 99',
            '100-499' => ' AND `coins`.`price` BETWEEN 100 AND 499',
            '500-999' => ' AND `coins`.`price` BETWEEN 500 AND 999',
            '1000-9999' => ' AND `coins`.`price` BETWEEN 1000 AND 9999',
            '10000+' => ' AND `coins`.`price` >= 10000',
            default => ''
        };
    }

    public static function getSqlSearch(string $searchName = null): string
    {
        if (!$searchName) {
            return '';
        }

        return ' AND `coins`.`name` LIKE ?';
    }

    public static function getSqlSort(string $sort = null): string
    {
        if (is_null($sort)) {
            return '';
        }

        return match ($sort) {
            'name' => ' ORDER BY `coins`.`name`',
            'price' => ' ORDER BY `coins`.`price`',
            'average-buy-price' => ' ORDER BY `average_buy_price`',
            'profit' => ' ORDER BY `profit`',
            'investment' => ' ORDER BY `investment`',
            default => ''
        };
    }

    public static function getSqlLimitAndOffset(int $limit = null, int $offset = null): string
    {
        if (is_null($limit)) {
            return '';
        }

        $limitSql = ' LIMIT ?';

        return $offset !== null ? $limitSql . ' OFFSET ?' : $limitSql;
    }

    public static function setParameters(array $params, &$sth): bool
    {
        // Получаем не пустые параметры
        $filterParams = array_values(array_filter($params, function ($value) {
            return $value !== null && $value !== '';
        }));

        try {
            // Добавляем в запрос параметры
            foreach ($filterParams as $index => $value) {
                if (is_int($value)) {
                    $sth->bindValue($index + 1, $value, \PDO::PARAM_INT);

                } else {
                    $sth->bindValue($index + 1, $value, \PDO::PARAM_STR);
                }
            }

            return true;

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();

            return false;
        }
    }
}
