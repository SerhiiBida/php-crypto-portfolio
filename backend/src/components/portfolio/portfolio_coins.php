<?php

use App\database\tables\CoinPortfolio;

// Удаление монеты
require_once __DIR__ . "/delete_coins_handler.php";
// Обработчик формы фильтрации, сортировки, поиска
require_once __DIR__ . '/portfolio_coins_filter_handler.php';

$coinPortfolio = new CoinPortfolio();

// Данные для поиска
function getDataSetting(): array
{
    $portfolioId = intval($_GET['page-id']);
    $userId = $_SESSION['userId'];

    // Данные из формы фильтрации, сортировки, поиска
    $filterPrice = $_SESSION['portfolio']['filterPrice'] ?? null;
    $sort = $_SESSION['portfolio']['sort'] ?? null;
    $searchName = $_SESSION['portfolio']['searchName'] ?? null;

    return [
        $portfolioId,
        $userId,
        $searchName,
        $sort,
        $filterPrice
    ];
}

// Количество страниц
function getTotalPages(int $limit): int
{
    global $coinPortfolio;

    [$portfolioId, $userId, $searchName, $sort, $filterPrice] = getDataSetting();

    $coinsAmountArray = $coinPortfolio->getCountCoinsForPortfolio($portfolioId, $userId, $searchName, $filterPrice);

    if (is_null($coinsAmountArray)) {
        return 0;
    }

    $coinsAmount = $coinsAmountArray[0];

    if ($coinsAmount < 1) {
        return 0;
    }

    return ceil($coinsAmount / $limit);
}

function nextPageLink(): string
{
    global $paginationPage;

    $pageId = $_GET['page-id'];
    $nextPage = $paginationPage + 1;

    $params = "?page-id=$pageId&pagination-page=$nextPage";

    return $_SERVER['PHP_SELF'] . $params;
}

function prevPageLink(): string
{
    global $paginationPage;

    $pageId = $_GET['page-id'];
    $nextPage = $paginationPage - 1;

    $params = "?page-id=$pageId&pagination-page=$nextPage";

    return $_SERVER['PHP_SELF'] . $params;
}

function isPage(bool $isNext): bool
{
    global $paginationPage, $totalPages;

    if ($isNext) {
        $newPage = $paginationPage + 1;
    } else {
        $newPage = $paginationPage - 1;
    }

    if ($newPage <= $totalPages && $newPage > 0) {
        return true;
    }

    return false;
}

// Пагинация
function pagination(): bool
{
    global $coinPortfolio, $coinsData, $paginationPage, $totalPages;

    $coinsData = [];

    $limit = 5;

    // Текущая страница
    $paginationPage = intval($_GET['pagination-page'] ?? 1);

    // Всего страниц
    $totalPages = getTotalPages($limit);

    if (!$totalPages) {
        $coinsData = [];

        return false;
    }

    if ($paginationPage < 1 || $paginationPage > $totalPages) {
        $paginationPage = 1;
        $_GET['pagination-page'] = 1;
    }

    // Пропуск записей не текущей страницы
    $offset = intval(($paginationPage - 1) * $limit);

    [$portfolioId, $userId, $searchName, $sort, $filterPrice] = getDataSetting();

    // Получение данных
    $coinsData = $coinPortfolio->getCoinsForPortfolio(
        $portfolioId,
        $userId,
        $searchName,
        $sort,
        $filterPrice,
        $limit,
        $offset
    );

    if (is_null($coinsData)) {
        $coinsData = [];

        return false;
    }

    return true;
}

$isPagination = pagination();
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
                        <!--Форма удаления монеты-->

                        <?php require __DIR__ . '/delete_coins_form.php'; ?>
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
    <!--Пагинация-->
    <?php if ($isPagination): ?>
        <div class="portfolio-coins-pagination">
            <a
                    href="<?php echo prevPageLink(); ?>"
                    class="submit-btn <?php echo isPage(false) ? '' : 'disabled-link'; ?>"
            >
                <
            </a>
            <a
                    href="<?php echo nextPageLink(); ?>"
                    class="submit-btn <?php echo isPage(true) ? '' : 'disabled-link'; ?>"
            >
                >
            </a>
            <p>
                <?php echo "$paginationPage of $totalPages pages" ?>
            </p>
        </div>
    <?php endif; ?>
</section>
