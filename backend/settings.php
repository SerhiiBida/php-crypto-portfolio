<?php

// Установка времени сохранения сессии и куки
ini_set('session.gc_maxlifetime', (int)getenv('SESSION_TIME')); // 2 дня
ini_set('session.cookie_lifetime', (int)getenv('SESSION_TIME'));

// Подключаем библиотеки и namespace
require_once __DIR__ . '/vendor/autoload.php';

// Проверки авторизации для сессии и сохранения данных
require_once __DIR__ . '/src/auth/check_authorization.php';

// Проверка прав доступа
require_once __DIR__ . '/src/router/router.php';