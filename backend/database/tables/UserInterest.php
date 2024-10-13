<?php

namespace Database\Tables;


class UserInterest
{
    public static string $table = '
        CREATE TABLE IF NOT EXISTS `user_interest` (
            `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `user_id` INT NOT NULL,
            `interest_id` INT NOT NULL,
            FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
            FOREIGN KEY (`interest_id`) REFERENCES `interests` (`id`)
        );
    ';
}
