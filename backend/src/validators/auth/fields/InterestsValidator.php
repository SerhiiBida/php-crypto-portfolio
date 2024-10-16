<?php

namespace App\validators\auth\fields;

use App\database\tables\Interests;
use App\validators\interfaces\FieldValidatorInterface;

class InterestsValidator implements FieldValidatorInterface
{
    /**
     * Валидатор для поля interests
     */
    public static function validate(string $fieldName, $value, array &$errors): bool
    {
        // Получаем уникальные значения и преобразуем их в int
        $inputInterestsIds = array_map('intval', array_unique($value));

        // Есть ли такие id в БД
        $InterestsObj = new Interests();

        $foundInterestsIds = $InterestsObj->getExistingIds($inputInterestsIds);

        if (is_null($foundInterestsIds)) {
            $errors[$fieldName] = 'Please try again later';

            return false;
        }

        $differences = array_diff($inputInterestsIds, $foundInterestsIds);

        // Не все id найдены
        if (!empty($differences)) {
            $errors[$fieldName] = 'Select again';

            return false;
        }

        return true;
    }
}
