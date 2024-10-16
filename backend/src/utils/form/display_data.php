<?php

// Вывод старых значений если есть
function formTextValue($fieldName): string
{
    return isset($_POST[$fieldName]) ? htmlspecialchars($_POST[$fieldName]) : '';
}

function formSelectValue($fieldName, $value): string
{
    $value = strval($value);

    if (isset($_POST[$fieldName])) {
        return $_POST[$fieldName] === $value ? 'selected' : '';
    }

    return '';
}

function formSelectArrayValue($fieldName, $value): string
{
    $value = strval($value);

    if (isset($_POST[$fieldName])) {
        return in_array($value, $_POST[$fieldName]) ? 'selected' : '';
    }

    return '';
}

function formCheckboxArrayValue($fieldName, $value): string
{
    $value = strval($value);

    if (isset($_POST[$fieldName])) {
        return in_array($value, $_POST[$fieldName]) ? 'checked' : '';
    }

    return '';
}

function formRadioCheckboxValue($fieldName, $value): string
{
    $value = strval($value);

    if (isset($_POST[$fieldName])) {
        return $_POST[$fieldName] === $value ? 'checked' : '';
    }

    return '';
}
