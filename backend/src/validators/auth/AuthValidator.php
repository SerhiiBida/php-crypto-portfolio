<?php

namespace App\validators\auth;

use App\validators\auth\fields\UsernameValidator;
use App\validators\interfaces\AdditionalValidatorInterface;


class AuthValidator implements AdditionalValidatorInterface
{
    /**
     * Валидация авторизации и регистрации
     *
     * @string $type -> 'login' or 'register'
     */
    public function __construct(private readonly bool $isLogin)
    {

    }

    public function validate(array $fields, array &$errors): bool
    {
        $check = true;

        // Валидация
        foreach ($fields as $fieldName => $data) {
            if ($fieldName === 'username') {
                $check = !UsernameValidator::validate($this->isLogin, $fieldName, $data['value'], $errors) ? false : $check;
            }
        }

        return $check;
    }
}
