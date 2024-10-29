<?php
// Фильтрация
$prices = [
    'default' => 'default',
    '0-99' => '0 - 99 $',
    '100-499' => '100 - 499 $',
    '500-999' => '500 - 999 $',
    '1000-9999' => '1000 - 9999 $',
    '10000+' => '10000+ $'
];

// Сортировка
$sorts = [
    'default' => 'default',
    'name' => 'Name',
    'price' => 'Price',
    'average-buy-price' => 'Avg. Buy Price',
    'profit' => 'Profit/Loss',
    'investment' => 'Investment'
];

// Вывод старых значений
function portfolioCoinsSelectValue(string $fieldName, string $value): string
{
    $oldValue = null;

    if ($fieldName === 'filter-price') {
        $oldValue = $_SESSION['portfolio']['filterPrice'] ?? null;
    }

    if ($fieldName === 'sort') {
        $oldValue = $_SESSION['portfolio']['sort'] ?? null;
    }

    return $oldValue === $value ? 'selected' : '';
}

?>
<form
        action="<?php echo $_SERVER['PHP_SELF'] . '?page-id=' . $_GET['page-id']; ?>"
        method="post"
        class="portfolio-coins-filter-form"
>
    <div class="portfolio-coins-filter-form-select-price">
        <label>
            Prices:
            <select id="filter-price" name="filter-price">
                <?php foreach ($prices as $key => $price): ?>
                    <option
                            value="<?php echo $key ?>"
                        <?php echo portfolioCoinsSelectValue('filter-price', $key); ?>
                    >
                        <?php echo $price ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
    </div>
    <div class="portfolio-coins-filter-form-select-sort">
        <label>
            Sort
            <select id="sort" name="sort">
                <?php foreach ($sorts as $key => $sort): ?>
                    <option
                            value="<?php echo $key ?>"
                        <?php echo portfolioCoinsSelectValue('sort', $key); ?>
                    >
                        <?php echo $sort ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
    </div>
    <div class="portfolio-coins-filter-form-input-name custom-input-wrapper">
        <label>
            <input
                    type="text"
                    name="search-name"
                    placeholder="Name"
                    value="<?php echo $_SESSION['portfolio']['searchName'] ?? ''; ?>"
                    min="0"
            >
        </label>
    </div>
    <input type="hidden" name="portfolio-coins-filter-form" value="true">
    <input type="hidden" name="page-id" value="<?php echo $_GET['page-id']; ?>">
    <button type="submit" class="portfolio-coins-filter-form-submit submit-btn">
        Search
    </button>
</form>
