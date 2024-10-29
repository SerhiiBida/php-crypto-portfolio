<?php

use App\database\tables\CoinPortfolio;
use App\validators\forms\AddCoinValidator;
use App\validators\GlobalValidator;


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add-coin-form'])) {
    // Обнуляем
    $_SESSION['formErrors'] = [];

    // Сырые данные
    $rawData = [
        'coin' => [
            'type' => 'int',
            'value' => $_POST['coin'] ?? null,
        ],
        'amount' => [
            'type' => 'float',
            'value' => $_POST['amount'] ?? null,
        ],
        'money' => [
            'type' => 'float',
            'value' => $_POST['money'] ?? null,
        ],
    ];

    // Дополнительная валидация
    $addCoinValidator = new AddCoinValidator();

    // Валидация
    $validator = new GlobalValidator($rawData, $addCoinValidator);

    if ($validator->validate()) {
        $coinId = intval(trim($_POST['coin']));
        $portfolioId = intval(trim($_GET['page-id']));
        $coinsAmount = trim($_POST['amount']);
        $money = trim($_POST['money']);

        // Сохраняем в портфеле
        $coinPortfolio = new CoinPortfolio();

        $coinPortfolio->add($coinId, $portfolioId, $coinsAmount, $money);

        $_POST['amount'] = '';
        $_POST['money'] = '';

    } else {
        // Сохраняем ошибки
        $_SESSION['formErrors'] = $validator->errors;
    }
}
