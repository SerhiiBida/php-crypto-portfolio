<?php

namespace App\database\interfaces;


interface TableInterface
{
    public function getAll(): ?array;
}
