<?php
// Установка времени сохранения сессии и куки
ini_set('session.gc_maxlifetime', 172800);  // 2 дня
ini_set('session.cookie_lifetime', 172800);

// Еси авторизован, то создаем или продолжаем сессию
if (isset($_COOKIE['isAuth'])) {
    session_start();
}

// Подключаем библиотеки и namespace
require __DIR__ . '/vendor/autoload.php';