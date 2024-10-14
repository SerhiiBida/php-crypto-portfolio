<?php

use App\validators\GlobalValidator;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    echo json_encode($_POST);

    $requiredTextFields = [
        'username' => 'str',
        'email' => 'str',
        'password' => 'str',
        'birthday' => 'date',
        'salary' => 'float',
        'years-experience' => 'int',
        'country' => 'int',
        'languages' => 'array-int',
        'interests' => 'array-int',
        'gender' => 'str',
        'terms' => 'bool'
    ];

    // Сырые данные
    $rawData = [];

    // Подготовка текстовых данных
    foreach ($requiredTextFields as $field => $type) {
        if (isset($_POST[$field])) {
            $rawData[$field] = [$type, $_POST[$field]];

        } else {
            $rawData[$field] = [$type, null];
        }
    }

    // Подготовка файловых данных
    if (isset($_FILES['profile-picture'])) {
        $rawData['profile-picture'] = ['file', $_FILES['profile-picture']];

    } else {
        $rawData['profile-picture'] = ['file', null];
    }

    $validator = new GlobalValidator($rawData, 'registration');

    $check = $validator->validate();

    if ($check) {
        // Сохраняем пользователя

    } else {
        // Отображаем ошибки и старые данные
        $oldData = $validator->oldData;
        $formErrors = $validator->errors;
    }
}