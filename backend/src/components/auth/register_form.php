<?php

use App\database\tables\Countries;
use App\database\tables\Interests;
use App\database\tables\Languages;

// Обработчик формы
require 'register_handler.php';

// Данные для select и т.д.
$countriesTable = new Countries();
$interestsTable = new Interests();
$languagesTable = new Languages();

$countries = $countriesTable->getAll();
$interests = $interestsTable->getAll();
$languages = $languagesTable->getAll();
?>
<!--action - на текущую страницу-->
<form
        action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>"
        method="post"
        class="register-form"
>
    <div class="register-form-username custom-input-wrapper">
        <label for="username" class="register-form-username-label custom-input-label">
            Username
        </label>
        <input
                type="text"
                name="username"
                id="username"
                placeholder="food228"
                class="register-form-username-input custom-input"
                minlength="5"
                maxlength="32"
                required
        >
        <p class="register-form-username-error custom-input-error"></p>
    </div>
    <div class="register-form-email custom-input-wrapper">
        <label for="email" class="register-form-email-label custom-input-label">
            Email
        </label>
        <input
                type="email"
                name="email"
                id="email"
                placeholder="food@gmail.com"
                class="register-form-email-input custom-input"
                maxlength="255"
                required
        >
        <p class="register-form-email-error custom-input-error"></p>
    </div>
    <div class="register-form-password custom-input-wrapper">
        <label for="password" class="register-form-password-label custom-input-label">
            Password
        </label>
        <input
                type="password"
                name="password"
                id="password"
                placeholder="********"
                class="register-form-password-input custom-input"
                minlength="8"
                maxlength="16"
                required
        >
        <p class="register-form-password-error custom-input-error"></p>
    </div>
    <div class="register-form-birthday custom-input-wrapper">
        <label for="birthday" class="register-form-birthday-label custom-input-label">
            Birthday
        </label>
        <input
                type="date"
                name="birthday"
                id="birthday"
                placeholder="2000-01-01"
                class="register-form-birthday-input custom-input"
                required
        >
        <p class="register-form-birthday-error custom-input-error"></p>
    </div>
    <div class="register-form-salary custom-input-wrapper">
        <label for="salary" class="register-form-salary-label custom-input-label">
            Salary, $
        </label>
        <input
                type="number"
                name="salary"
                id="salary"
                placeholder="3433.35"
                class="register-form-salary-input custom-input"
                required
        >
        <p class="register-form-salary-error custom-input-error"></p>
    </div>
    <div class="register-form-years-experience custom-input-wrapper">
        <label for="years-experience" class="register-form-years-experience-label custom-input-label">
            Years of experience (BTC and others)
        </label>
        <input
                type="number"
                name="years-experience"
                id="years-experience"
                placeholder="5"
                class="register-form-years-experience-input custom-input"
                required
        >
        <p class="register-form-years-experience-error custom-input-error"></p>
    </div>
    <div class="register-form-country">
        <label for="country">
            Country of Residence:
        </label>
        <select id="country" name="country" class="register-form-country-select">
            <?php foreach ($countries as $country): ?>
                <option value="<?php echo $country['id'] ?>">
                    <?php echo $country['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="register-form-languages">
        <label for="languages">
            Languages mastered:
        </label>
        <select id="languages" name="languages" multiple>
            <?php foreach ($languages as $language): ?>
                <option value="<?php echo $language['id'] ?>">
                    <?php echo $language['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="register-form-interests">
        <p>
            Interests:
        </p>
        <div class="register-form-interests-checkboxes">
            <?php foreach ($interests as $interest): ?>
                <label>
                    <input type="checkbox" name="interests" value="<?php echo $interest['id'] ?>">
                    <?php echo $interest['name'] ?>
                </label>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="register-form-gender">
                <span>
                    Gender:
                </span>
        <label>
            <input
                    type="radio"
                    name="gender"
                    value="male"
                    class="register-form-male-radio"
                    required
            >
            Male
        </label>
        <label>
            <input
                    type="radio"
                    name="gender"
                    value="female"
                    class="register-form-female-radio"
                    required
            >
            Female
        </label>
    </div>
    <div class="register-form-profile-picture">
        <label for="profile-picture">
            Profile photo:
        </label>
        <input
                type="file"
                id="profile-picture"
                name="profile-picture"
                accept="image/png, image/gif, image/jpeg"
                required
        >
        <p class="register-form-profile-picture-error custom-input-error"></p>
    </div>
    <div class="register-form-terms">
        <label>
            <input
                    type="checkbox"
                    name="terms"
                    required
            >
            I agree to provide personal data.
        </label>
    </div>
    <button type="submit" class="register-form-submit submit-btn">
        Log in
    </button>
</form>
