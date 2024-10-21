<?php

use App\database\tables\Portfolios;


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

// Проверка прав на доступ к портфелю
if ($currentPage === 'portfolio') {
    // Нет id в URL портфеля
    if (!isset($_GET['page-id'])) {
        header('Location: ./portfolios.php');
        exit();
    }

    $portfoliosObj = new Portfolios();

    // Портфель не принадлежит пользователю
    if (!$portfoliosObj->isRecordOwnedByUser($_GET['page-id'], $_SESSION['userId'])) {
        header('Location: ./portfolios.php');
        exit();
    }
}



