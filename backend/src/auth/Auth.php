<?php

namespace App\auth;

use App\database\tables\UserInterest;
use App\database\tables\UserLanguage;
use App\database\tables\Users;


class Auth
{
    /**
     * Авторизация и регистрация пользователя
     */
    public static function getNewRandomToken(): string
    {
        $usersDb = new Users();

        // Выполнять, пока токен не будет уникальный
        do {
            $token = bin2hex(random_bytes(32));

            $isToken = $usersDb->isToken($token);
        } while ($isToken);

        return $token;
    }

    public static function rememberUser(array $user): void
    {
        $token = Auth::getNewRandomToken();

        $usersDb = new Users();

        // Сохраняем токен в БД и Cookie
        if ($usersDb->addToken($user['id'], $token)) {
            setcookie('token', $token, time() + 2592000, '/'); // 30 дней
        }
    }

    public static function saveUserInCookie(string $userId, string $username): void
    {
        $sessionTime = (int)getenv('SESSION_TIME');

        $time = time() + $sessionTime;

        setcookie('auth', 'true', $time, '/');
        setcookie('userId', $userId, $time, '/');
        setcookie('username', $username, $time, '/');
    }

    public static function createSessionUser(int $userId, string $username): void
    {
        session_start();

        $_SESSION['auth'] = true;
        $_SESSION['userId'] = $userId;
        $_SESSION['username'] = $username;
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
        Auth::saveUserInCookie(strval($userId), $data['username']);
        Auth::createSessionUser($userId, $data['username']);

        return true;
    }

    public static function login(array $data, array &$errors, bool $rememberMe = false): bool
    {
        // Есть ли такой username
        $users = new Users();

        $usernames = $users->searchUsernames($data['username']);

        if (is_null($usernames)) {
            $errors['auth'] = 'Please try again later';

            return false;
        }

        if (!in_array($data['username'], $usernames)) {
            $errors['auth'] = 'Incorrect username or password';

            return false;
        }

        // Получаем данные пользователя для проверки
        $user = $users->getByUsername($data['username']);

        if (is_null($user)) {
            $errors['auth'] = 'Please try again later';

            return false;
        }

        if (empty($user)) {
            $errors['auth'] = 'Incorrect username or password';

            return false;
        }

        // Проверка пароля
        $userHash = $user['password'];

        if (!password_verify($data['password'], $userHash)) {
            $errors['auth'] = 'Incorrect username or password';

            return false;
        }

        if ($rememberMe) {
            // Запоминаем пользователя на 30 дней
            Auth::rememberUser($user);
        }

        // Авторизация в cookie и session
        Auth::saveUserInCookie(strval($user['id']), $data['username']);
        Auth::createSessionUser(intval($user['id']), $data['username']);

        return true;
    }

    public static function logout(): void
    {
        if (isset($_COOKIE['auth'])) {
            $time = time() - 3600;

            // Очищаем куки
            setcookie('auth', '', $time, '/');
            setcookie('userId', '', $time, '/');
            setcookie('username', '', $time, '/');
            setcookie('email', '', $time, '/');
            setcookie('token', '', $time, '/');

            // Завершаем и очищаем сессию
            session_destroy();
        }
    }
}
