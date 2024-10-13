<?php

namespace Database\Tables;


class Interests
{
    public static string $table = '
        CREATE TABLE IF NOT EXISTS `interests` (
            `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL
        );
    ';
}