<?php

namespace App\validators\interfaces;


interface ValidatorMethods
{
    public static function validate($value, array &$errors): bool;
}
