<?php

namespace App\validators\auth\fields;

use App\database\tables\Countries;
use App\validators\interfaces\FieldValidatorInterface;

class CountryValidator implements FieldValidatorInterface
{
    /**
     * Валидатор для поля country
     */
    public static function validate(string $fieldName, $value, array &$errors): bool
    {
        $countryId = intval($value);

        if ($countryId < 1) {
            $errors[$fieldName] = 'Cannot be less than 1';

            return false;
        }

        // Есть ли такое в БД
        $countries = new Countries();

        $check = $countries->existsById($countryId);

        if (is_null($check)) {
            $errors[$fieldName] = 'Please try again later';

            return false;
        }

        if (!$check) {
            $errors[$fieldName] = 'There is no such country';

            return false;
        }

        return true;
    }
}
