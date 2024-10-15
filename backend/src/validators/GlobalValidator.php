<?php

namespace App\validators;

use App\validators\abstraction\GlobalValidatorAbstract;
use App\validators\interfaces\AdditionalValidatorInterface;
use App\validators\types\ArrayIntValidator;
use App\validators\types\BoolValidator;
use App\validators\types\DateValidator;
use App\validators\types\FileValidator;
use App\validators\types\FloatValidator;
use App\validators\types\IntegerValidator;
use App\validators\types\StringValidator;


class GlobalValidator extends GlobalValidatorAbstract
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
    public array $errors = [];

    public function __construct(private array $fields, public ?AdditionalValidatorInterface $additionalValidator = null)
    {

    }

    public function validate(): bool
    {
        $check = true;

        // Основная валидация
        foreach ($this->fields as $fieldName => $data) {
            if ($data['type'] === 'str') {
                $check = !StringValidator::validate($fieldName, $data['value'], $this->errors) ? false : $check;
            }

            if ($data['type'] === 'int') {
                $check = !IntegerValidator::validate($fieldName, $data['value'], $this->errors) ? false : $check;
            }

            if ($data['type'] === 'float') {
                $check = !FloatValidator::validate($fieldName, $data['value'], $this->errors) ? false : $check;
            }

            if ($data['type'] === 'bool') {
                $check = !BoolValidator::validate($fieldName, $data['value'], $this->errors) ? false : $check;
            }

            if ($data['type'] === 'array-int') {
                $check = !ArrayIntValidator::validate($fieldName, $data['value'], $this->errors) ? false : $check;
            }

            if ($data['type'] === 'date') {
                $check = !DateValidator::validate($fieldName, $data['value'], $this->errors) ? false : $check;
            }

            if ($data['type'] === 'file') {
                $check = !FileValidator::validate($fieldName, $data['value'], $this->errors) ? false : $check;
            }
        }

        return $check;
    }
}