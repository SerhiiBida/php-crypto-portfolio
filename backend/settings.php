<?php

// Установка времени сохранения сессии и куки
ini_set('session.gc_maxlifetime', (int)getenv('SESSION_TIME'));
ini_set('session.cookie_lifetime', (int)getenv('SESSION_TIME'));

// Если авторизован, то создаем или продолжаем сессию
if (isset($_COOKIE['auth'])) {
    session_start();
}

// Подключаем библиотеки и namespace
require __DIR__ . '/vendor/autoload.php';

// Проверка прав доступа
require __DIR__ . '/src/router/router.php';