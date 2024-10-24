<?php

use App\database\tables\CoinPortfolio;

// Обработчик формы фильтрации, сортировки, поиска
require_once __DIR__ . '/portfolio_coins_filter_handler.php';

// Данные из формы фильтрации, сортировки, поиска
$filterPrice = $_SESSION['portfolio']['filterPrice'] ?? null;
$sort = $_SESSION['portfolio']['sort'] ?? null;
$searchName = $_SESSION['portfolio']['searchName'] ?? null;

// Пагинация

// Получение данных из БД
$coinPortfolio = new CoinPortfolio();

$portfolioId = $_GET['page-id'];
$userId = $_SESSION['userId'];

$coinsData = $coinPortfolio->getCoinsForPortfolio($portfolioId, $userId);

?>
<section class="portfolio-coins">
    <div class="portfolio-coins-header">
        <div class="portfolio-coins-header-title">
            <span class="portfolio-coins-header-icon material-symbols-outlined opacity-60">
                work
            </span>
            <h2>
                Assets
            </h2>
        </div>
        <?php require_once __DIR__ . '/portfolio_coins_filter_form.php'; ?>
    </div>
    <div class="portfolio-coins-table-wrapper">
        <table class="portfolio-coins-table">
            <tr class="portfolio-coins-table-header">
                <th>
                    Name
                </th>
                <th>
                    Price
                </th>
                <th>
                    Holding
                </th>
                <th>
                    Avg. Buy Price
                </th>
                <th>
                    Profit/Loss
                </th>
                <th>
                    Investment
                </th>
                <th>
                    Actions
                </th>
            </tr>
            <?php foreach ($coinsData as $coin): ?>
                <tr>
                    <td>
                        <?php echo $coin['name'] ?>
                    </td>
                    <td>
                        <?php echo (float)$coin['price'] . ' $' ?>
                    </td>
                    <td>
                        <?php echo (float)$coin['real_price_investment'] . ' $' ?>
                        <br>
                        <?php echo (float)$coin['amount'] . " {$coin['symbol']}" ?>
                    </td>
                    <td>
                        <?php echo (float)$coin['average_buy_price'] . ' $' ?>
                    </td>
                    <td>
                        <?php echo (float)$coin['profit'] . ' $' ?>
                    </td>
                    <td>
                        <?php echo (float)$coin['investment'] . ' $' ?>
                    </td>
                    <td>
                        <button class="portfolio-coins-table-button submit-btn">
                            DELETE
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            <!--Если пусто-->
            <?php if (empty($coinsData)): ?>
                <tr>
                    <td colspan="7">
                        No data available
                    </td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
    <div class="portfolio-coins-pagination">
        <a href="#" class="submit-btn">
            <
        </a>
        <a href="#" class="submit-btn">
            >
        </a>
        <p>
            1 of 2 pages
        </p>
    </div>
</section>
