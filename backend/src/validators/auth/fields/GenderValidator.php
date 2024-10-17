<?php

namespace App\validators\auth\fields;

use App\validators\interfaces\FieldValidatorInterface;


class GenderValidator implements FieldValidatorInterface
{
    /**
     * Валидатор для поля gender
     */
    public static function validate(string $fieldName, $value, array &$errors): bool
    {
        if ($value !== 'male' && $value !== 'female') {
            $errors[$fieldName] = "'Must be 'male' or 'female'";

            return false;
        }

        return true;
    }
}


