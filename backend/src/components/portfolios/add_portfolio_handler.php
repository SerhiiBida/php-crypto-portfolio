<?php

use App\database\tables\Portfolios;
use App\validators\GlobalValidator;


// Обнуляем
$formErrors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add-portfolio-form'])) {
    // Сырые данные
    $rawData = [
        'name' => [
            'type' => 'str',
            'value' => $_POST['name'] ?? null,
        ]
    ];

    // Валидация
    $validator = new GlobalValidator($rawData);

    $check = $validator->validate();

    if ($check) {
        // Дополнительная валидация
        if (strlen($_POST['name']) < 6 || strlen($_POST['name']) > 18) {
            $formErrors['name'] = 'The required length is from 6 to 18';

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
        $formErrors = $validator->errors;
    }
}
