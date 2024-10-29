<?php

namespace App\validators\abstraction;

use App\validators\interfaces\AdditionalValidatorInterface;

abstract class AbstractValidator
{
    /**
     * @array $fields - поля формы:
     * $form = ['field1' => ['type' => 'str', 'value' => $_POST['field1'], ...]
     * $value -> имеет тип string или array
     *
     * @AdditionalValidatorInterface $additionalValidator - дополнительный валидатор,
     *  например, для аутентификации, основанный на интерфейсе AdditionalValidatorInterface
     */
    public array $errors = [];

    public function __construct(
        protected array                      $fields,
        public ?AdditionalValidatorInterface $additionalValidator = null
    )
    {

    }

    // Поля в которых не найдено ошибок(1 поле = 1 ошибка в $errors)
    protected function getCorrectFields(): array
    {
        return array_filter($this->fields, function ($key) {
            return !array_key_exists($key, $this->errors);
        }, ARRAY_FILTER_USE_KEY);
    }

    abstract public function validate(): bool;
}
