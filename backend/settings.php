<?php

// Установка времени сохранения сессии и куки
ini_set('session.gc_maxlifetime', (int)getenv('SESSION_TIME'));
ini_set('session.cookie_lifetime', (int)getenv('SESSION_TIME'));

// Если авторизован, то создаем или продолжаем сессию
if (isset($_COOKIE['auth'])) {
    session_start();
}

if (isset($_COOKIE['auth']) && session_status() !== PHP_SESSION_NONE) {
    // Если в сессии нет данных из куки про пользователя
    if (!isset($_SESSION['auth'])) {
        $_SESSION['auth'] = true;
        $_SESSION['userId'] = intval($_COOKIE['userId']);
        $_SESSION['username'] = $_COOKIE['username'];
    }
}

// Подключаем библиотеки и namespace
require __DIR__ . '/vendor/autoload.php';

// Проверка прав доступа
require __DIR__ . '/src/router/router.php';