<?php

// Отображение ошибок и старых данных
use App\database\tables\Coins;

require_once __DIR__ . '/../../utils/form/display_data.php';
require_once __DIR__ . '/../../utils/form/display_errors.php';

// Данные для выбора монет
$coinsObj = new Coins();

$coinsData = $coinsObj->getAll();

if (is_null($coinsData)) {
    $coinsData = [];
}
?>
<form
        action="<?php echo $_SERVER['PHP_SELF'] ?>?page-id=<?php echo $_GET['page-id']; ?>"
        method="post"
        class="add-coin-form"
>
    <h2 class="add-coin-form-title">
        Add a coin
    </h2>
    <div class="add-coin-form-select-coin">
        <label>
            <select id="coin" name="coin">
                <?php foreach ($coinsData as $coin): ?>
                    <option
                            value="<?php echo $coin['id'] ?>"
                        <?php echo formSelectValue('coin', $coin['id']); ?>
                    >
                        <?php echo $coin['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
    </div>
    <p class="add-coin-form-select-coin-error">
        <?php echo getFieldError('coin', 'add-coin-form'); ?>
    </p>
    <div class="add-coin-form-input-amount custom-input-wrapper <?php echo getClassBorderError('amount') ?>">
        <label>
            <input
                    type="number"
                    name="amount"
                    placeholder="Amount of coins"
                    value="<?php echo formTextValue('amount', 'add-coin-form'); ?>"
                    required
            >
        </label>
    </div>
    <p class="add-coin-form-input-amount-error">
        <?php
        echo getFieldError('amount', 'add-coin-form');
        ?>
    </p>
    <div class="add-coin-form-input-money custom-input-wrapper <?php echo getClassBorderError('money') ?>">
        <label>
            <input
                    type="number"
                    name="money"
                    placeholder="Investments, $"
                    value="<?php echo formTextValue('money', 'add-coin-form'); ?>"
                    required
            >
        </label>
    </div>
    <p class="add-coin-form-input-money-error">
        <?php
        echo getFieldError('money', 'add-coin-form');
        // Удаляем проверочное значение, так как форма отработала уже
        unset($_POST['add-coin-form']);
        ?>
    </p>
    <input type="hidden" name="add-coin-form" value="true">
    <input type="hidden" name="page-id" value="<?php echo $_GET['page-id']; ?>">
    <button type="submit" class="add-coin-form-submit submit-btn">
        ADD
    </button>
</form>

