<?php

namespace Database\Tables;


class Languages
{
    public static string $table = '
        CREATE TABLE IF NOT EXISTS `languages` (
            `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL
        );
    ';
}