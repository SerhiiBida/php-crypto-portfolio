<?php

namespace App\validators\auth\fields;

use App\validators\interfaces\FieldValidatorInterface;

class YearsExperienceValidator implements FieldValidatorInterface
{
    /**
     * Валидатор для поля years-experience
     */
    public static function validate(string $fieldName, $value, array &$errors): bool
    {
        $yearsExperience = intval($value);

        if ($yearsExperience > 100) {
            $errors[$fieldName] = 'No more than 100';

            return false;
        }

        return true;
    }
}
