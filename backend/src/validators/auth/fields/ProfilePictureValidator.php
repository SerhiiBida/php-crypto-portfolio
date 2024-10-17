<?php

namespace App\validators\auth\fields;

use App\validators\interfaces\FieldValidatorInterface;


class ProfilePictureValidator implements FieldValidatorInterface
{
    /**
     * Валидатор для поля profile-picture
     */
    public static function validate(string $fieldName, $value, array &$errors): bool
    {
        $file = $value;

        $validFiles = ['png', 'gif', 'jpeg', 'jpg'];

        // Проверка типа полученного файла
        $currentTypeFile = pathinfo($file['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($currentTypeFile), $validFiles)) {
            $errors[$fieldName] = 'Supported formats: ' . implode(', ', $validFiles);

            return false;
        }

        $validMimeTypes = ['image/png', 'image/gif', 'image/jpeg', 'image/jpg'];

        // Проверка типа MIME у файла
        $currentMimeType = mime_content_type($file['tmp_name']);

        if (!in_array($currentMimeType, $validMimeTypes)) {
            $errors[$fieldName] = 'Supported mime types: ' . implode(', ', $validMimeTypes);

            return false;
        }

        // Файл больше 2 Мб
        if ($file['size'] > 2 * 1024 * 1024) {
            $errors[$fieldName] = 'The file size must be less than 2 MB.';

            return false;
        }

        return true;
    }
}


