<?php

namespace App\validators\types;

use App\validators\interfaces\TypeValidatorInterface;


class FileValidator implements TypeValidatorInterface
{
    /**
     * Валидатор для файлов, input[type="file"]
     */
    public static function validate(string $fieldName, $value, array &$errors): bool
    {
        if (is_null($value)) {
            $errors[$fieldName] = 'Cannot be empty';

            return false;
        }

        // Проверка ошибок загрузки
        if ($value['error'] !== UPLOAD_ERR_OK) {
            $errors[$fieldName] = 'Error loading file';

            return false;
        }

        return true;
    }
}

