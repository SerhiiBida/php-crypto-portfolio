<?php

// РОУТИНГ
// Виды страниц
$authPages = ['login', 'register'];

$generalPages = ['index'];

// Текущая страница(без .php)
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

// Пользователь не авторизован
if (empty($_COOKIE['auth']) && !in_array($currentPage, $authPages) && !in_array($currentPage, $generalPages)) {
    header('Location: ./login.php');
    exit();
}

// Пользователь не авторизован и пытается выйти из акаунта
if (empty($_COOKIE['auth']) && $currentPage === 'logout') {
    header('Location: ./login.php');
    exit();
}

// Пользователь авторизован
if (isset($_COOKIE['auth']) && in_array($currentPage, $authPages)) {
    header('Location: ./portfolios.php');
    exit();
}



