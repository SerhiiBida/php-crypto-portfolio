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
    public static function saveUserInCookie(string $userId, string $username): void
    {
        $sessionTime = (int)getenv('SESSION_TIME');

        setcookie('auth', 'true', time() + $sessionTime, '/');
        setcookie('userId', $userId, time() + $sessionTime, '/');
        setcookie('username', $username, time() + $sessionTime, '/');
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

    public static function login(array $data, array &$errors): bool
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

        // Авторизация в cookie и session
        Auth::saveUserInCookie(strval($user['id']), $data['username']);
        Auth::createSessionUser(intval($user['id']), $data['username']);

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

            echo 'dfhdfhfhfdhdhfd' . '<br>';

            // Завершаем и очищаем сессию
            session_destroy();
        }
    }
}
