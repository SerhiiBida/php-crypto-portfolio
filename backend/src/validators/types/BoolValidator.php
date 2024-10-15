<?php

namespace App\validators\types;

use App\validators\interfaces\TypeValidatorInterface;


class BoolValidator implements TypeValidatorInterface
{
    /**
     * Валидатор для обязательного логического значения, checkbox
     */
    public static function validate(string $fieldName, $value, array &$errors): bool
    {
        if (empty($value)) {
            $errors[$fieldName] = 'Cannot be empty';

            return false;
        }

        if ($value !== 'on') {
            $errors[$fieldName] = 'Must be checked';

            return false;
        }

        return true;
    }
}

