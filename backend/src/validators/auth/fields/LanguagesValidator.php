<?php

namespace App\validators\auth\fields;

use App\database\tables\Languages;
use App\validators\interfaces\FieldValidatorInterface;

class LanguagesValidator implements FieldValidatorInterface
{
    /**
     * Валидатор для поля languages
     */
    public static function validate(string $fieldName, $value, array &$errors): bool
    {
        // Получаем уникальные значения и преобразуем их в int
        $inputLanguageIds = array_map('intval', array_unique($value));

        // Есть ли такие id в БД
        $languagesObj = new Languages();

        $foundLanguageIds = $languagesObj->getExistingIds($inputLanguageIds);

        if (is_null($foundLanguageIds)) {
            $errors[$fieldName] = 'Please try again later';

            return false;
        }

        $differences = array_diff($inputLanguageIds, $foundLanguageIds);

        // Не все id найдены
        if (!empty($differences)) {
            $errors[$fieldName] = 'Select again';

            return false;
        }

        return true;
    }
}
