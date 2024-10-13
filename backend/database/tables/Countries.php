<?php

namespace Database\Tables;


class Countries
{
    public static string $table = '
        CREATE TABLE IF NOT EXISTS `countries` (
            `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL
        );
    ';
}
