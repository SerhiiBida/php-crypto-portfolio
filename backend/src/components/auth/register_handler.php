<?php

use App\validators\auth\AuthValidator;
use App\validators\GlobalValidator;


// Храним ошибки
$formErrors = [];

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //echo json_encode($_POST);

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

    // Подготовка файловых данных
    if (isset($_FILES['profile-picture'])) {
        $rawData['profile-picture'] = [
            'type' => 'file',
            'value' => $_FILES['profile-picture']
        ];

    } else {
        $rawData['profile-picture'] = [
            'type' => 'file',
            'value' => null
        ];
    }

    $authValidator = new AuthValidator('register');

    $validator = new GlobalValidator($rawData, $authValidator);

    $check = $validator->validate();

    if ($check) {
        // Сохраняем пользователя

    } else {
        global $formErrors;

        // Сохраняем ошибки
        $formErrors = $validator->errors;
    }
}

// Вывод старых значений если есть
function formTextValue($fieldName): string
{
    return isset($_POST[$fieldName]) ? htmlspecialchars($_POST[$fieldName]) : '';
}


// Вывод ошибки
function getFieldError($fieldName): string
{
    global $formErrors;

    return $formErrors[$fieldName] ?? '';
}


// Добавление классов ошибок css
function getClassError($fieldName): string
{
    global $formErrors;

    return isset($formErrors[$fieldName]) ? 'text-error' : '';
}

function getClassBorderError($fieldName): string
{
    global $formErrors;

    return isset($formErrors[$fieldName]) ? 'border-error' : '';
}