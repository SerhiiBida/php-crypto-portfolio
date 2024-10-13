<?php
// Установка времени сохранения сессии и куки
ini_set('session.gc_maxlifetime', 172800);  // 2 дня
ini_set('session.cookie_lifetime', 172800);

// Еси авторизован, то создаем или продолжаем сессию
if (isset($_COOKIE['isAuth'])) {
    session_start();
}


// Подключение к базе данных
$host = getenv('DB_HOST_NETWORK');
$db = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}