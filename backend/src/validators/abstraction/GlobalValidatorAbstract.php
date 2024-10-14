<?php

namespace App\validators\abstraction;


abstract class GlobalValidatorAbstract
{
    abstract public function validate(): bool;
}
