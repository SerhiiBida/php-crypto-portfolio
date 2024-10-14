<?php

namespace App\validators;

use App\validators\abstraction\GlobalValidatorAbstract;


class GlobalValidator extends GlobalValidatorAbstract
{
    /**
     * Главный класс для запуска валидации
     */
    public array $oldData;
    public array $errors;

    public function __construct(public array $fields, public string $characteristic = '')
    {

    }

    public function validate(): bool
    {

    }
}