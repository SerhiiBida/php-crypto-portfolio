<?php

namespace App\faker;

use App\database\tables\CoinPortfolio;
use App\database\tables\Coins;
use App\database\tables\Interests;
use App\database\tables\Languages;
use App\database\tables\Portfolios;
use App\database\tables\UserInterest;
use App\database\tables\UserLanguage;
use Faker\Factory;

use App\database\tables\Countries;
use App\database\tables\Users;

class Faker
{
    private function users(int $count): void
    {
        $faker = Factory::create();
        $users = new Users();

        // Все ids стран
        $countries = new Countries();

        $countriesIds = $countries->getAllIds();

        if ($countriesIds) {
            for ($i = 0; $i < $count; $i++) {
                $username = $faker->unique()->userName;
                $email = $faker->unique()->safeEmail;
                $password = password_hash($faker->password, PASSWORD_DEFAULT);
                $birthday = $faker->date('Y-m-d');
                $salary = $faker->randomFloat(2, 5, 150000);
                $yearsExperience = $faker->numberBetween(1, 40);
                $countryId = $faker->randomElement($countriesIds);
                $gender = $faker->randomElement(['male', 'female']);
                $profile_picture = file_get_contents(__DIR__ . '/../assets/images/user-profile.png');

                $users->add($username, $email, $password, $birthday, $salary, $yearsExperience, $countryId, $gender, $profile_picture);
            }

            echo "The 'users' table is full!\n";
        }
    }

    private function userInterest(int $count): void
    {
        $faker = Factory::create();
        $userInterest = new UserInterest();

        // Все ids пользователей и интересов
        $users = new Users();
        $interests = new Interests();

        $usersIds = $users->getAllIds();
        $interestsIds = $interests->getAllIds();

        if ($usersIds && $interestsIds) {
            for ($i = 0; $i < $count; $i++) {
                $userId = $faker->randomElement($usersIds);
                $interestId = $faker->randomElement($interestsIds);

                $userInterest->add($userId, $interestId);
            }

            echo "The 'user_interest' table is full!\n";
        }
    }

    private function userLanguage(int $count): void
    {
        $faker = Factory::create();
        $userLanguage = new UserLanguage();

        // Все ids пользователей и интересов
        $users = new Users();
        $languages = new Languages();

        $usersIds = $users->getAllIds();
        $languagesIds = $languages->getAllIds();

        if ($usersIds && $languagesIds) {
            for ($i = 0; $i < $count; $i++) {
                $userId = $faker->randomElement($usersIds);
                $languageId = $faker->randomElement($languagesIds);

                $userLanguage->add($userId, $languageId);
            }

            echo "The 'user_language' table is full!\n";
        }
    }

    private function coins(int $count): void
    {
        $faker = Factory::create();
        $coins = new Coins();

        for ($i = 0; $i < $count; $i++) {
            $name = $faker->word;
            $symbol = strtoupper($faker->lexify('???'));
            $price = $faker->randomFloat(2, 0.01, 5000.00);

            $coins->add($name, $symbol, $price);
        }

        echo "The 'coins' table is full!\n";
    }

    private function portfolios(int $count): void
    {
        $faker = Factory::create();
        $portfolios = new Portfolios();

        // Все ids пользователей
        $users = new Users();

        $usersIds = $users->getAllIds();

        if ($usersIds) {
            for ($i = 0; $i < $count; $i++) {
                $name = $faker->word;
                $userId = $faker->randomElement($usersIds);

                $portfolios->add($name, $userId);
            }

            echo "The 'portfolios' table is full!\n";
        }
    }

    private function coinPortfolio(int $count): void
    {
        $faker = Factory::create();
        $coinPortfolio = new CoinPortfolio();

        // Все ids портфелей и монет
        $portfolios = new Portfolios();
        $coins = new Coins();

        $portfoliosIds = $portfolios->getAllIds();
        $coinsIds = $coins->getAllIds();

        if ($portfoliosIds && $coinsIds) {
            for ($i = 0; $i < $count; $i++) {
                $coinId = $faker->randomElement($coinsIds);
                $portfolioId = $faker->randomElement($portfoliosIds);
                $coinsAmount = strval($faker->randomFloat(2, 1, 100));
                $money = strval($faker->randomFloat(2, 1, 3000));

                $coinPortfolio->add($coinId, $portfolioId, $coinsAmount, $money);
            }

            echo "The 'coin_portfolio' table is full!\n";
        }
    }

    public function start(): void
    {
        //$this->users(1000);
        //$this->userLanguage(1000);
        //$this->userInterest(1000);
        //$this->coins(1000);
        //$this->portfolios(1000);
        //$this->coinPortfolio(10000);
    }
}