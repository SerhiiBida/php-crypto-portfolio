<?php

namespace App\validators\types;

use App\validators\interfaces\TypeValidatorInterface;


class IntegerValidator implements TypeValidatorInterface
{
    /**
     * Валидатор для целых чисел, input[type="number"]
     */
    public static function validate(string $fieldName, $value, array &$errors): bool
    {
        if (is_null($value) || trim(strval($value)) === '') {
            $errors[$fieldName] = 'Cannot be empty';

            return false;
        }

        if ((!is_string($value) && !is_int($value)) || filter_var($value, FILTER_VALIDATE_INT) === false) {
            $errors[$fieldName] = 'There must be a integer';

            return false;
        }

        return true;
    }
}