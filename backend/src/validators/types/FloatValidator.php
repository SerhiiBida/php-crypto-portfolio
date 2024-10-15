<?php

namespace App\validators\types;

use App\validators\interfaces\TypeValidatorInterface;


class FloatValidator implements TypeValidatorInterface
{
    /**
     * Валидатор для чисел с плавающей запятой, input[type="number"]
     */
    public static function validate(string $fieldName, $value, array &$errors): bool
    {
        if (is_null($value) || trim(strval($value)) === '') {
            $errors[$fieldName] = 'Cannot be empty';

            return false;
        }

        if ((!is_string($value) && !is_float($value)) || filter_var($value, FILTER_VALIDATE_FLOAT) === false) {
            $errors[$fieldName] = 'There must be a float';

            return false;
        }

        return true;
    }
}
