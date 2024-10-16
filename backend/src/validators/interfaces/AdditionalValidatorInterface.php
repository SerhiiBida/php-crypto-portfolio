<?php

namespace App\validators\interfaces;


interface AdditionalValidatorInterface
{
    /**
     * Интерфейс для дополнительных валидаторов
     * передаваемых в GlobalValidator
     */
    public function validate(array $fields, array &$errors): bool;
}
