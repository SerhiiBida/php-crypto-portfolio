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

        echo $value . '<br>';

        if (!is_string($value) && !is_int($value)) {
            $errors[$fieldName] = 'There must be a number';

            return false;
        }

        if (filter_var($value, FILTER_VALIDATE_INT) === false) {
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