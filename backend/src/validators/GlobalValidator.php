<?php

namespace App\validators;

use App\validators\abstraction\AbstractValidator;
use App\validators\types\ArrayIntValidator;
use App\validators\types\BoolValidator;
use App\validators\types\DateValidator;
use App\validators\types\FileValidator;
use App\validators\types\FloatValidator;
use App\validators\types\IntegerValidator;
use App\validators\types\StringValidator;


class GlobalValidator extends AbstractValidator
{
    /**
     * Главный класс для запуска валидации
     *
     * @array $fields - поля формы:
     * $form = ['field1' => ['type' => 'str', 'value' => $_POST['field1'], ...]
     * $value -> имеет тип string или array
     *
     * @AdditionalValidatorInterface $additionalValidator - дополнительный валидатор,
     *  например, для аутентификации, основанный на интерфейсе AdditionalValidatorInterface
     */
    private array $validators = [
        'str' => StringValidator::class,
        'int' => IntegerValidator::class,
        'float' => FloatValidator::class,
        'bool' => BoolValidator::class,
        'array-int' => ArrayIntValidator::class,
        'date' => DateValidator::class,
        'file' => FileValidator::class,
    ];

    public function validate(): bool
    {
        $check = true;

        // Основная валидация
        foreach ($this->fields as $fieldName => $data) {
            $type = $data['type'];
            $peculiarity = $data['peculiarity'] ?? null;
            $value = $data['value'];

            $validatorClass = $this->validators[$type];

            // Проверка
            $isValid = ($type === 'str')
                ? $validatorClass::validate($fieldName, $value, $this->errors, $peculiarity)
                : $validatorClass::validate($fieldName, $value, $this->errors);

            $check = !$isValid ? false : $check;
        }

        // Запуск дополнительной валидации
        if (!is_null($this->additionalValidator) && count($this->errors) < count($this->fields)) {
            // Поля у которых не найдено ошибок
            $correctFields = $this->getCorrectFields();

            if (!empty($correctFields)) {
                $check = !$this->additionalValidator->validate($correctFields, $this->errors) ? false : $check;
            }
        }

        return $check;
    }
}