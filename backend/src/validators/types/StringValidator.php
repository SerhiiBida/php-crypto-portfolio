<?php

namespace App\validators\types;

use App\validators\interfaces\TypeValidatorInterface;


class StringValidator implements TypeValidatorInterface
{
    /**
     * Валидатор для строк, input[type="text"]
     */
    public static function validate(string $fieldName, $value, array &$errors, $peculiarity = null): bool
    {
        if ($peculiarity !== 'empty' && (empty($value) || trim(strval($value)) === '')) {
            $errors[$fieldName] = 'Cannot be empty';

            return false;
        }

        if (!is_string($value)) {
            $errors[$fieldName] = 'There must be a string';

            return false;
        }

        return true;
    }
}
