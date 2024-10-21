<?php

// Вывод ошибки
function getFieldError($fieldName, $formName = null): string
{
    // Получение данных
    if (!is_null($formName)) {
        // Если форм много на странице(авторизован пользователь)
        $formErrors = $_COOKIE['auth'] && isset($_SESSION['formErrors']) ? $_SESSION['formErrors'] : [];

    } else {
        global $formErrors;
    }

    // Это форма не отправлена
    if (!is_null($formName) && !isset($_POST[$formName])) {
        return '';
    }

    return $formErrors[$fieldName] ?? '';
}


// Добавление классов ошибок css
function getClassError($fieldName): string
{
    global $formErrors;

    return isset($formErrors[$fieldName]) ? 'text-error' : '';
}

function getClassBorderError($fieldName, $formName = null): string
{
    global $formErrors;

    // Если форм много на странице
    if (!is_null($formName) && !isset($_POST[$formName])) {
        return '';
    }

    return isset($formErrors[$fieldName]) ? 'border-error' : '';
}
