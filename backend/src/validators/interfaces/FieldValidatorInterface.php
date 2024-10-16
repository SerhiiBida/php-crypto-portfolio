<?php

namespace App\validators\interfaces;


interface FieldValidatorInterface
{
    public static function validate(string $fieldName, $value, array &$errors): bool;
}
