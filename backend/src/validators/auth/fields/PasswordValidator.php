<?php

namespace App\validators\auth\fields;

use App\validators\interfaces\FieldValidatorInterface;


class PasswordValidator implements FieldValidatorInterface
{
    /**
     * Валидатор для поля password
     */
    public static function validate(string $fieldName, $value, array &$errors): bool
    {
        if (strlen($value) < 8 || strlen($value) > 16) {
            $errors[$fieldName] = 'The required length is from 8 to 16';

            return false;
        }

        if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,16}$/', $value)) {
            $errors[$fieldName] = 'Requires one number, an uppercase letter, a lowercase letter, and a special character';

            return false;
        }

        return true;
    }
}
