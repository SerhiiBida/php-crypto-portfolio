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

        if (!is_string($value) && !is_float($value)) {
            $errors[$fieldName] = 'There must be a number';

            return false;
        }

        if (filter_var($value, FILTER_VALIDATE_FLOAT) === false) {
            $errors[$fieldName] = 'The number is too high';

            return false;
        }

        $number = floatval($value);

        if ($number < 0) {
            $errors[$fieldName] = 'Cannot be less than 0';

            return false;
        }

        return true;
    }
}
