<?php

namespace App\validators\auth;

use App\validators\auth\fields\BirthdayValidator;
use App\validators\auth\fields\CountryValidator;
use App\validators\auth\fields\EmailValidator;
use App\validators\auth\fields\GenderValidator;
use App\validators\auth\fields\LanguagesValidator;
use App\validators\auth\fields\PasswordValidator;
use App\validators\auth\fields\InterestsValidator;
use App\validators\auth\fields\ProfilePictureValidator;
use App\validators\auth\fields\SalaryValidator;
use App\validators\auth\fields\UsernameValidator;
use App\validators\auth\fields\YearsExperienceValidator;
use App\validators\interfaces\AdditionalValidatorInterface;


class AuthValidator implements AdditionalValidatorInterface
{
    /**
     * Валидация авторизации и регистрации
     *
     * @string $type -> 'login' or 'register'
     */
    public function __construct(private readonly bool $isLogin)
    {

    }

    public function validate(array $fields, array &$errors): bool
    {
        $check = true;

        // Валидация
        foreach ($fields as $fieldName => $data) {
            if ($fieldName === 'username') {
                $check = !UsernameValidator::validate($this->isLogin, $fieldName, $data['value'], $errors) ? false : $check;
            }

            if ($fieldName === 'email') {
                $check = !EmailValidator::validate($fieldName, $data['value'], $errors) ? false : $check;
            }

            if ($fieldName === 'password') {
                $check = !PasswordValidator::validate($this->isLogin, $fieldName, $data['value'], $errors) ? false : $check;
            }

            if ($fieldName === 'birthday') {
                $check = !BirthdayValidator::validate($fieldName, $data['value'], $errors) ? false : $check;
            }

            if ($fieldName === 'salary') {
                $check = !SalaryValidator::validate($fieldName, $data['value'], $errors) ? false : $check;
            }

            if ($fieldName === 'years-experience') {
                $check = !YearsExperienceValidator::validate($fieldName, $data['value'], $errors) ? false : $check;
            }

            if ($fieldName === 'country') {
                $check = !CountryValidator::validate($fieldName, $data['value'], $errors) ? false : $check;
            }

            if ($fieldName === 'languages') {
                $check = !LanguagesValidator::validate($fieldName, $data['value'], $errors) ? false : $check;
            }

            if ($fieldName === 'interests') {
                $check = !InterestsValidator::validate($fieldName, $data['value'], $errors) ? false : $check;
            }

            if ($fieldName === 'gender') {
                $check = !GenderValidator::validate($fieldName, $data['value'], $errors) ? false : $check;
            }

            if ($fieldName === 'profile-picture') {
                $check = !ProfilePictureValidator::validate($fieldName, $data['value'], $errors) ? false : $check;
            }
        }

//        // Если авторизация
//        if ($this->isLogin) {
//            // Поиск пользователя
//
//        }

        return $check;
    }
}
