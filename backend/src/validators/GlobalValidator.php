<?php

namespace App\validators;

use App\validators\abstraction\GlobalValidatorAbstract;
use App\validators\primitives\IntegerValidator;
use App\validators\primitives\StringValidator;


class GlobalValidator extends GlobalValidatorAbstract
{
    /**
     * Главный класс для запуска валидации
     */
    public array $errors = [];

    public function __construct(public array $fields, public string $characteristic = '')
    {
        
    }

    public function validate(): bool
    {
        $check = true;

        // Основная валидация
        foreach ($this->fields as $field => $data) {
            if ($data['type'] === 'str') {
                $check = !StringValidator::validate($field, $data['value'], $this->errors) ? false : $check;
            }

//            if ($data['type'] === 'int') {
//                $check = !IntegerValidator::validate($field, $data['value'], $this->errors) ? false : $check;
//            }
        }

        return $check;
    }
}