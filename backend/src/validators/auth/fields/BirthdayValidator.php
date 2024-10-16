<?php

namespace App\validators\auth\fields;

use App\validators\interfaces\FieldValidatorInterface;


class BirthdayValidator implements FieldValidatorInterface
{
    /**
     * Валидатор для поля birthday
     */
    public static function validate(string $fieldName, $value, array &$errors): bool
    {
        if (strtotime($value) > strtotime('now')) {
            $errors[$fieldName] = 'The date is invalid';

            return false;
        }

        $currentDate = date_create();
        $birthdayDate = date_create($value);

        $difference = (int)date_diff($currentDate, $birthdayDate)->format("%y");

        if ($difference < 18) {
            $errors[$fieldName] = 'You must be 18';

            return false;
        }

        return true;
    }
}



