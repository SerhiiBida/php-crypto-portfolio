<?php

namespace App\validators\auth\fields;

use App\database\tables\Users;
use App\validators\auth\interfaces\AuthFieldValidatorInterface;


class UsernameValidator implements AuthFieldValidatorInterface
{
    /**
     * Валидатор для поля username
     */
    public static function validate(bool $isLogin, string $fieldName, $value, array &$errors): bool
    {
        if (strlen($value) < 6 || strlen($value) > 18) {
            $errors[$fieldName] = 'The required length is from 6 to 18';

            return false;
        }

        if (!preg_match('/^[a-zA-Z]/', $value)) {
            $errors[$fieldName] = 'Must start with a letter';

            return false;
        }

        if (!preg_match('/^[a-z]\w{2,18}[^_]$/i', $value)) {
            $errors[$fieldName] = 'Only letters, numbers, no spaces';

            return false;
        }

        // Регистрация
        if (!$isLogin) {
            // Есть ли такой username
            $users = new Users();

            $usernames = $users->searchUsernames($value);

            if (is_null($usernames)) {
                $errors[$fieldName] = 'Please try again later';

                return false;
            }

            if (in_array($value, $usernames)) {
                $errors[$fieldName] = 'Username already exists';

                return false;
            }
        }

        return true;
    }
}

