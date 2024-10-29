<?php

use App\auth\Auth;
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

    // Валидация
    $authValidator = new AuthValidator(false);

    $validator = new GlobalValidator($rawData, $authValidator);

    $check = $validator->validate();

    if ($check) {
        // Готовим данные
        $data = [];

        $data['username'] = trim($_POST['username']);
        $data['email'] = trim($_POST['email']);
        $data['password'] = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
        $data['birthday'] = trim($_POST['birthday']);
        $data['salary'] = floatval($_POST['salary']);
        $data['yearsExperience'] = intval($_POST['years-experience']);
        $data['countryId'] = intval($_POST['country']);
        $data['gender'] = trim($_POST['gender']);
        $data['profilePicture'] = file_get_contents($_FILES['profile-picture']['tmp_name']);

        // Регистрируем пользователя
        $check = Auth::register($data, $formErrors);

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