<?php

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
