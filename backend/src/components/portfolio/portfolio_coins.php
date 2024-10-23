<?php
// Обработка фильтрации, сортировки, поиска
// Пагинация
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
                    Invested
                </th>
                <th>
                    Actions
                </th>
            </tr>
            <tr>
                <td>
                    Bitcoin
                </td>
                <td>
                    65450 $
                </td>
                <td>
                    345.567 $
                    <br>
                    0.000006 btc
                </td>
                <td>
                    25560 $
                </td>
                <td>
                    -78 $
                </td>
                <td>
                    1200 $
                </td>
                <td>
                    <button class="portfolio-coins-table-button submit-btn">
                        DELETE
                    </button>
                </td>
            </tr>
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
