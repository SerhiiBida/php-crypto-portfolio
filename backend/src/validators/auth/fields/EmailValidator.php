<?php

namespace App\validators\auth\fields;

use App\database\tables\Users;
use App\validators\interfaces\FieldValidatorInterface;


class EmailValidator implements FieldValidatorInterface
{
    /**
     * Валидатор для поля email
     */
    public static function validate(string $fieldName, $value, array &$errors): bool
    {
        if (strlen($value) > 255) {
            $errors[$fieldName] = 'Must be no longer than 255';

            return false;
        }

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $errors[$fieldName] = 'Invalid email address';

            return false;
        }

        // Есть ли такой email
        $users = new Users();

        $emails = $users->searchEmails($value);

        if (is_null($emails)) {
            $errors[$fieldName] = 'Please try again later';

            return false;
        }

        if (in_array($value, $emails)) {
            $errors[$fieldName] = 'Email already exists';

            return false;
        }

        return true;
    }
}


