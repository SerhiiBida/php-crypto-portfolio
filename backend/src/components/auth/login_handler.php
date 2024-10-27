<?php

use App\components\auth\Auth;
use App\validators\auth\AuthValidator;
use App\validators\GlobalValidator;


// Храним ошибки
$formErrors = [];

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //echo json_encode($_POST);

    $requiredTextFields = [
        'username' => 'str',
        'password' => 'str'
    ];

    // Сырые данные
    $rawData = [];

    // Подготовка текстовых данных
    foreach ($requiredTextFields as $field => $type) {
        if (isset($_POST[$field])) {
            $rawData[$field] = [
                'type' => $type,
                'value' => $_POST[$field]
            ];

        } else {
            $rawData[$field] = [
                'type' => $type,
                'value' => null
            ];
        }
    }

    // Валидация
    $authValidator = new AuthValidator(true);

    $validator = new GlobalValidator($rawData, $authValidator);

    $check = $validator->validate();

    if ($check) {
        // Готовим данные
        $data = [];

        $data['username'] = trim($_POST['username']);
        $data['password'] = trim($_POST['password']);

        // Запомнить ли пользователя
        if (isset($_POST['terms']) && $_POST['terms'] == 'on') {
            $rememberMe = true;
        } else {
            $rememberMe = false;
        }

        // Авторизовываем пользователя
        $check = Auth::login($data, $formErrors, $rememberMe);

        if ($check) {
            // Перенаправляем на страницу с портфелями
            header('Location: ./portfolios.php');
            exit();
        }

    } else {
        // Сохраняем ошибки
        $formErrors = $validator->errors;
    }
}