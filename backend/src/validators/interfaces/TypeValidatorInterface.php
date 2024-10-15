<?php

namespace App\validators\interfaces;


interface TypeValidatorInterface
{
    public static function validate(string $fieldName, $value, array &$errors): bool;
}