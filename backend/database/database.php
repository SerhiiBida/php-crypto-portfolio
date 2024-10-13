<?php

namespace Database;


class Users
{
    static public string $table = '
        CREATE TABLE IF NOT EXISTS `users` (
            `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `username` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `birthday` DATE NOT NULL,
            `salary` FLOAT NOT NULL,
            `years_experience` INT NOT NULL,
            `country_id` INT NOT NULL,
            `gender` VARCHAR(255) NOT NULL,
            `profile_picture` BLOB NOT NULL,
            FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`)
        );
    ';
}


class Languages
{
    static public string $table = '
        CREATE TABLE IF NOT EXISTS `languages` (
            `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL
        );
    ';
}


class Countries
{
    static public string $table = '
        CREATE TABLE IF NOT EXISTS `countries` (
            `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL
        );
    ';
}