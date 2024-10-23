<?php
// Фильтрация
$prices = [1 => 'default', '0 - 99 $', '100 - 499 $', '500 - 999 $', '1000 - 9999 $', '10000+ $'];

// Сортировка
$sorts = [1 => 'default', 'Name', 'Price', 'Avg. Buy Price', 'Profit/Loss', 'Invested'];

require_once __DIR__ . '/'
?>
<form
        action="<?php echo $_SERVER['PHP_SELF'] . '?page-id=' . $_GET['page-id']; ?>"
        method="post"
        class="portfolio-coins-filter-form"
>
    <div class="portfolio-coins-filter-form-select-price">
        <label>
            Prices:
            <select id="price" name="price">
                <?php foreach ($prices as $key => $price): ?>
                    <option
                            value="<?php echo $key ?>"
                        <?php echo formSelectValue('price', $key); ?>
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
                        <?php echo formSelectValue('sort', $key); ?>
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
                    name="name"
                    placeholder="Name"
                    value="<?php echo formTextValue('name', 'portfolio-coins-filter-form'); ?>"
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
