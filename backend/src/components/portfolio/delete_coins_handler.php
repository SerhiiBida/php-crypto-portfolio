<?php

use App\database\tables\CoinPortfolio;
use App\validators\GlobalValidator;


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete-coins-form'])) {
    // Сырые данные
    $rawData = [
        'coinId' => [
            'type' => 'int',
            'value' => $_POST['coin-id'] ?? null,
        ]
    ];

    // Валидация
    $validator = new GlobalValidator($rawData);

    $check = $validator->validate();

    if ($check) {
        $portfolioId = intval(trim($_GET['page-id']));
        $userId = $_SESSION['userId'];
        $coinId = intval(trim($_POST['coin-id']));

        // Удаляем монету из портфеля
        $coinPortfolio = new CoinPortfolio();

        $coinPortfolio->deleteCoinFromPortfolio($portfolioId, $userId, $coinId);
    }

    unset($_POST['delete-coins-form']);
}

