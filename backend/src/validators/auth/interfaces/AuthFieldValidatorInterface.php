<?php

namespace App\validators\auth\interfaces;


interface AuthFieldValidatorInterface
{
    public static function validate(bool $isLogin, string $fieldName, $value, array &$errors): bool;
}

