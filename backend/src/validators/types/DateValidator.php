<?php

namespace App\validators\types;

use App\validators\interfaces\TypeValidatorInterface;


class DateValidator implements TypeValidatorInterface
{
    /**
     * Валидатор для дат, input[type="date"]
     */
    public static function validate(string $fieldName, $value, array &$errors): bool
    {
        if (empty($value) || trim($value) === '') {
            $errors[$fieldName] = 'Cannot be empty';

            return false;
        }

        $inputDate = \DateTime::createFromFormat('Y-m-d', $value);

        if (!$inputDate || $inputDate->format('Y-m-d') !== $value) {
            $errors[$fieldName] = 'There must be a date in the format YYYY-MM-DD';

            return false;
        }

        return true;
    }
}
