<?php

namespace App\database\tables;


class UserLanguage
{
    /**
     * Таблица 'user_language'
     */
    public static string $table = '
        CREATE TABLE IF NOT EXISTS `user_language` (
            `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `user_id` INT NOT NULL,
            `language_id` INT NOT NULL,
            FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
            FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`)
        );
    ';
}