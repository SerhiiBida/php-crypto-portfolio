<?php

namespace App\validators\auth\fields;

use App\validators\interfaces\FieldValidatorInterface;

class SalaryValidator implements FieldValidatorInterface
{
    /**
     * Валидатор для поля salary
     */
    public static function validate(string $fieldName, $value, array &$errors): bool
    {
        $salary = floatval($value);

        if ($salary > 100_000_000) {
            $errors[$fieldName] = 'No more than 100,000,000';

            return false;
        }

        return true;
    }
}