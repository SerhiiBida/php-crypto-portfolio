<?php

use App\database\tables\Portfolios;
use App\validators\GlobalValidator;


// Обнуляем
$formErrors = [];

// Проверка отправки динамической формы
function checkSubmitDynamicForm(string $formName, array $data): bool
{
    $keys = array_keys($data);

    foreach ($keys as $key) {
        if (str_starts_with($key, $formName)) {
            return true;
        }
    }

    return false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && checkSubmitDynamicForm('change-portfolio-form', $_POST)) {
    // Сырые данные
    $rawData = [
        'id' => [
            'type' => 'int',
            'value' => $_POST['portfolio-id'] ?? null,
        ],
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
            $portfolio = new Portfolios();

            $id = intval($_POST['portfolio-id']);
            $name = trim($_POST['name']);

            if (isset($_POST['submit-button']) && $_POST['submit-button'] === 'change') {
                // Изменяем
                $portfolio->updateName($id, $name);

            } elseif (isset($_POST['submit-button']) && $_POST['submit-button'] === 'delete') {
                // Удаляем
                $portfolio->delete($id);
            }
        }

    } else {
        // Сохраняем ошибки
        $formErrors = $validator->errors;
    }
}
