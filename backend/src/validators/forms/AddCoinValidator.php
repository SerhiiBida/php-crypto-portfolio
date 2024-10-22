<?php

namespace App\validators\forms;

use App\database\tables\Coins;
use App\validators\interfaces\AdditionalValidatorInterface;


class AddCoinValidator implements AdditionalValidatorInterface
{
    /**
     * Валидация для формы добавления монет в портфель
     */
    public function validate(array $fields, array &$errors): bool
    {
        $check = true;

        // Валидация
        foreach ($fields as $fieldName => $data) {
            // Поле coin с id
            if ($fieldName === 'coin') {
                $id = intval($data['value']);

                $coinsObj = new Coins();

                if (!$coinsObj->existsById($id)) {
                    $errors[$fieldName] = 'Select again';

                    $check = false;
                }

                continue;
            }

            // Для других полей
            $valueFloat = floatval($data['value']);
            $valueStr = $data['value'];

            if ($valueFloat > 9_999_999_999) {
                $errors[$fieldName] = 'No more than 9,999,999,999';

                $check = false;

                continue;
            }

            // Количество знаков после запятой
            if (str_contains($valueStr, '.')) {
                $valueArray = explode('.', $valueStr);

                $amount = strlen($valueArray[1]);

                if ($amount > 10) {
                    $errors[$fieldName] = 'Not more than 10 decimal places.';

                    $check = false;
                }
            }
        }

        return $check;
    }
}
