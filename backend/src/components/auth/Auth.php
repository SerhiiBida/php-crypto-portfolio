<?php

namespace App\components\auth;

use App\database\tables\UserInterest;
use App\database\tables\UserLanguage;
use App\database\tables\Users;


class Auth
{
    /**
     * Авторизация и регистрация пользователя
     */
    public static function saveUserInCookie(int $userId, string $username, string $email): void
    {
        $sessionTime = (int)getenv('SESSION_TIME');

        $userIdStr = strval($userId);

        setcookie('auth', 'true', time() + $sessionTime, '/');
        setcookie('userId', $userIdStr, time() + $sessionTime, '/');
        setcookie('username', $username, time() + $sessionTime, '/');
        setcookie('email', $email, time() + $sessionTime, '/');
    }

    public static function createSessionUser(int $userId, string $username, string $email): void
    {
        session_start();

        $_SESSION['auth'] = true;
        $_SESSION['userId'] = $userId;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
    }

    public static function register(array $data, array &$errors): bool
    {
        // Сохраняем пользователя в БД
        $users = new Users();

        $userId = $users->add(
            $data['username'],
            $data['email'],
            $data['password'],
            $data['birthday'],
            $data['salary'],
            $data['yearsExperience'],
            $data['countryId'],
            $data['gender'],
            $data['profilePicture']
        );

        // Сохраняем другие данные пользователя
        if (!is_null($userId)) {
            $languages = array_map('intval', array_unique($_POST['languages']));
            $interests = array_map('intval', array_unique($_POST['interests']));

            $userLanguage = new UserLanguage();
            $userInterest = new UserInterest();

            $userLanguage->addRecordsForUser($userId, $languages);
            $userInterest->addRecordsForUser($userId, $interests);

        } else {
            $errors['auth'] = 'Registration failed, please try later';

            return false;
        }

        // Авторизация в cookie и session
        Auth::saveUserInCookie($userId, $data['username'], $data['email']);
        Auth::createSessionUser($userId, $data['username'], $data['email']);

        return true;
    }

    public static function logout(): void
    {
        if (isset($_COOKIE['auth'])) {
            // Очищаем куки
            setcookie('auth', '', time() - 3600, '/');
            setcookie('userId', '', time() - 3600, '/');
            setcookie('username', '', time() - 3600, '/');
            setcookie('email', '', time() - 3600, '/');

            // Завершаем и очищаем сессию
            session_destroy();
        }
    }
}
