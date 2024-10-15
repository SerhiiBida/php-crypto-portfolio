<?php

namespace App\validators\primitives;


use App\validators\interfaces\ValidatorMethods;

class StringValidator implements ValidatorMethods
{
    /**
     * Валидатор для строки
     */
    public static function validate(string $field, $value, array &$errors): bool
    {
        if (is_null($value) || $value === '') {
            $errors[$field] = 'Cannot be empty';

            return false;
        }

        if (!is_string($value)) {
            $errors[$field] = 'There must be a string';

            return false;
        }

        return true;
    }
}
