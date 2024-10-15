<?php

namespace App\validators\types;

use App\validators\interfaces\TypeValidatorInterface;


class ArrayIntValidator implements TypeValidatorInterface
{
    /**
     * Валидатор массива целых чисел, select[name="array[]"]
     */
    public static function validate(string $fieldName, $value, array &$errors): bool
    {
        if (empty($value)) {
            $errors[$fieldName] = 'You must select at least 1';

            return false;
        }

        if (!is_array($value)) {
            $errors[$fieldName] = 'There must be a array';

            return false;
        }

        $check = true;

        // Проверка типа каждого значения
        foreach ($value as $number) {
            $check = IntegerValidator::validate($fieldName, $number, $errors);

            if (!$check) {
                break;
            }
        }

        return $check;
    }
}
