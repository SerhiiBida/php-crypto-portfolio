<?php

namespace App\validators\interfaces;


interface ValidatorMethods
{
    public static function validate(string $field, $value, array &$errors): bool;
}
