<?php

use App\database\tables\Portfolios;
use App\validators\GlobalValidator;


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add-portfolio-form'])) {
    // Обнуляем
    $_SESSION['formErrors'] = [];

    // Сырые данные
    $rawData = [
        'name' => [
            'type' => 'str',
            'value' => $_POST['name'] ?? null,
        ]
    ];

    // Валидация
    $validator = new GlobalValidator($rawData);

    if ($validator->validate()) {
        // Дополнительная валидация
        if (strlen($_POST['name']) < 6 || strlen($_POST['name']) > 18) {
            $_SESSION['formErrors']['name'] = 'The required length is from 6 to 18';

        } else {
            // Сохраняем
            $portfolios = new Portfolios();

            $name = trim($_POST['name']);
            $userId = $_SESSION['userId'];

            $portfolios->add($name, $userId);

            $_POST['name'] = '';
        }

    } else {
        // Сохраняем ошибки
        $_SESSION['formErrors'] = $validator->errors;
    }
}
