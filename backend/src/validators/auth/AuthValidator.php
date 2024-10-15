<?php

namespace App\validators\auth;

use App\validators\interfaces\AdditionalValidatorInterface;


class AuthValidator implements AdditionalValidatorInterface
{
    /**
     * Валидация авторизации и регистрации
     *
     * @string $type -> 'login' or 'register'
     */
    public function __construct(private string $type)
    {

    }

    public function validate(): bool
    {
        return true;
    }
}
