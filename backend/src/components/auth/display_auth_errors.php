<?php

// Вывод ошибки
function getAuthError(): string
{
    global $formErrors;

    return $formErrors['auth'] ?? '';
}
