<?php

require __DIR__ . '/../../settings.php';

use App\components\auth\Auth;


if (isset($_COOKIE['auth'])) {
    // Выход из системы
    Auth::logout();

    header('location: ./login.php');
    exit();
}
