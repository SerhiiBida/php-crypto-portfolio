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
        // Проверка ошибок загрузки
        if ($value['file']['error'] !== UPLOAD_ERR_OK) {
            $errors[$fieldName] = 'Error loading file';

            return false;
        }

        return true;
    }
}

