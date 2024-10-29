<?php

use App\database\tables\Portfolios;
use App\validators\GlobalValidator;


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
    // Обнуляем
    $_SESSION['formErrors'] = [];

    $portfolio = new Portfolios();

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

    // Нет ошибок c id, даем возможность удалить
    if (!isset($_SESSION['formErrors']['id']) && isset($_POST['submit-button']) && $_POST['submit-button'] === 'delete') {
        $id = intval($_POST['portfolio-id']);

        // Портфель принадлежит пользователю
        if ($portfolio->isRecordOwnedByUser($id, $_SESSION['userId'])) {
            // Удаляем
            $portfolio->delete($id);
        }
    }

    // Валидация
    $validator = new GlobalValidator($rawData);

    // Глобальная проверка
    if ($validator->validate()) {
        // Дополнительная валидация
        if (strlen($_POST['name']) < 6 || strlen($_POST['name']) > 18) {
            $_SESSION['formErrors']['name'] = 'The required length is from 6 to 18';

        } else {
            if (isset($_POST['submit-button']) && $_POST['submit-button'] === 'change') {
                $id = intval($_POST['portfolio-id']);
                $name = trim($_POST['name']);

                // Портфель принадлежит пользователю
                if ($portfolio->isRecordOwnedByUser($id, $_SESSION['userId'])) {
                    // Изменяем
                    $portfolio->updateName($id, $name);
                }
            }
        }

    } else {
        // Сохраняем ошибки
        $_SESSION['formErrors'] = $validator->errors;
    }
}
