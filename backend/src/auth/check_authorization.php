<?php

use App\auth\Auth;
use App\database\tables\Users;

// Если авторизован, то создаем сессию
if (isset($_COOKIE['auth']) && isset($_COOKIE['PHPSESSID'])) {
    $oldSessionId = $_COOKIE['PHPSESSID'];

    session_start();

    // Совпадает ли в куках и в сессии id сессии
    if (session_id() !== $oldSessionId) {
        // Данные сессии неправдивые
        setcookie('auth', '', time(), '/');
        $_COOKIE['auth'] = null;

        session_destroy();
    }

} else {
    // Очищаем старые данные
    setcookie('auth', '', time(), '/');
    $_COOKIE['auth'] = null;
}

// Авторизация по "Запомни меня"(токен)
if (!isset($_COOKIE['auth']) && isset($_COOKIE['token'])) {
    $usersDb = new Users();

    $userData = $usersDb->getUserForToken($_COOKIE['token']);

    if ($userData) {
        // Сохраняем данные
        Auth::saveUserInCookie($userData['id'], $userData['username']);

        session_start();
    }
}

// Если в сессии нет данных из куки про пользователя
if (isset($_COOKIE['auth']) && session_status() !== PHP_SESSION_NONE) {
    if (!isset($_SESSION['auth'])) {
        $_SESSION['auth'] = true;
        $_SESSION['userId'] = intval($_COOKIE['userId']);
        $_SESSION['username'] = $_COOKIE['username'];
    }
}