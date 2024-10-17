<?php

use App\database\tables\Countries;
use App\database\tables\Interests;
use App\database\tables\Languages;

// Обработчик формы
require __DIR__ . '/register_handler.php';
// Отображение ошибок и старых данных
require __DIR__ . '/../../utils/form/display_data.php';
require __DIR__ . '/../../utils/form/display_errors.php';

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
        enctype="multipart/form-data"
>
    <div class="register-form-username custom-input-wrapper <?php echo getClassBorderError('username') ?>">
        <label
                for="username"
                class="register-form-username-label custom-input-label <?php echo getClassError('username') ?>"
        >
            Username
        </label>
        <input
                type="text"
                name="username"
                id="username"
                placeholder="food228"
                class="register-form-username-input custom-input"
                minlength="6"
                maxlength="18"
                value="<?php echo formTextValue('username'); ?>"
        >
    </div>
    <p class="register-form-username-error custom-input-error">
        <?php echo getFieldError('username'); ?>
    </p>
    <div class="register-form-email custom-input-wrapper <?php echo getClassBorderError('email') ?>">
        <label
                for="email"
                class="register-form-email-label custom-input-label <?php echo getClassError('email') ?>"
        >
            Email
        </label>
        <input
                type="email"
                name="email"
                id="email"
                placeholder="food@gmail.com"
                class="register-form-email-input custom-input"
                maxlength="255"
                value="<?php echo formTextValue('email'); ?>"
        >
    </div>
    <p class="register-form-email-error custom-input-error">
        <?php echo getFieldError('email'); ?>
    </p>
    <div class="register-form-password custom-input-wrapper  <?php echo getClassBorderError('password') ?>">
        <label
                for="password"
                class="register-form-password-label custom-input-label <?php echo getClassError('password') ?>"
        >
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
                value="<?php echo formTextValue('password'); ?>"
        >
    </div>
    <p class="register-form-password-error custom-input-error">
        <?php echo getFieldError('password'); ?>
    </p>
    <div class="register-form-birthday custom-input-wrapper  <?php echo getClassBorderError('birthday') ?>">
        <label
                for="birthday"
                class="register-form-birthday-label custom-input-label <?php echo getClassError('birthday') ?>"
        >
            Birthday
        </label>
        <input
                type="date"
                name="birthday"
                id="birthday"
                placeholder="2000-01-01"
                class="register-form-birthday-input custom-input"
                value="<?php echo formTextValue('birthday'); ?>"
        >
    </div>
    <p class="register-form-birthday-error custom-input-error">
        <?php echo getFieldError('birthday'); ?>
    </p>
    <div class="register-form-salary custom-input-wrapper  <?php echo getClassBorderError('salary') ?>">
        <label
                for="salary"
                class="register-form-salary-label custom-input-label <?php echo getClassError('salary') ?>"
        >
            Salary, $
        </label>
        <input
                type="number"
                name="salary"
                id="salary"
                placeholder="3433.35"
                min="0"
                max="100000000"
                maxlength="9"
                class="register-form-salary-input custom-input"
                value="<?php echo formTextValue('salary'); ?>"
        >
    </div>
    <p class="register-form-salary-error custom-input-error">
        <?php echo getFieldError('salary'); ?>
    </p>
    <div class="register-form-years-experience custom-input-wrapper <?php echo getClassBorderError('years-experience') ?>">
        <label
                for="years-experience"
                class="register-form-years-experience-label custom-input-label <?php echo getClassError('years-experience') ?>"
        >
            Years of experience (BTC and others)
        </label>
        <input
                type="number"
                name="years-experience"
                id="years-experience"
                placeholder="5"
                min="0"
                max="100"
                maxlength="3"
                class="register-form-years-experience-input custom-input"
                value="<?php echo formTextValue('years-experience'); ?>"
        >
    </div>
    <p class="register-form-years-experience-error custom-input-error">
        <?php echo getFieldError('years-experience'); ?>
    </p>
    <div class="register-form-country">
        <label for="country">
            Country of Residence:
        </label>
        <select id="country" name="country" class="register-form-country-select">
            <?php foreach ($countries as $country): ?>
                <option
                        value="<?php echo $country['id'] ?>"
                    <?php echo formSelectValue('country', $country['id']); ?>
                >
                    <?php echo $country['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <p class="register-form-country-error register-form-error">
        <?php echo getFieldError('country'); ?>
    </p>
    <div class="register-form-languages">
        <label for="languages">
            Languages mastered:
        </label>
        <select id="languages" name="languages[]" multiple>
            <?php foreach ($languages as $language): ?>
                <option
                        value="<?php echo $language['id'] ?>"
                    <?php echo formSelectArrayValue('languages', $language['id']); ?>
                >
                    <?php echo $language['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <p class="register-form-languages-error register-form-error">
        <?php echo getFieldError('languages'); ?>
    </p>
    <div class="register-form-interests">
        <p>
            Interests:
        </p>
        <div class="register-form-interests-checkboxes">
            <?php foreach ($interests as $interest): ?>
                <label>
                    <input
                            type="checkbox"
                            name="interests[]"
                            value="<?php echo $interest['id'] ?>"
                        <?php echo formCheckboxArrayValue('interests', $interest['id']); ?>
                    >
                    <?php echo $interest['name'] ?>
                </label>
            <?php endforeach; ?>
        </div>
    </div>
    <p class="register-form-interests-error register-form-error">
        <?php echo getFieldError('interests'); ?>
    </p>
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
                <?php echo formRadioCheckboxValue('gender', 'male'); ?>
            >
            Male
        </label>
        <label>
            <input
                    type="radio"
                    name="gender"
                    value="female"
                    class="register-form-female-radio"
                <?php echo formRadioCheckboxValue('gender', 'female'); ?>
            >
            Female
        </label>
    </div>
    <p class="register-form-gender-error register-form-error">
        <?php echo getFieldError('gender'); ?>
    </p>
    <div class="register-form-profile-picture">
        <label for="profile-picture">
            Profile photo:
        </label>
        <input
                type="file"
                name="profile-picture"
                id="profile-picture"
        >
    </div>
    <p class="register-form-profile-picture-error register-form-error">
        <?php echo getFieldError('profile-picture'); ?>
    </p>
    <div class="register-form-terms">
        <label>
            <input
                    type="checkbox"
                    name="terms"
                <?php echo formRadioCheckboxValue('terms', 'on'); ?>
            >
            I agree to provide personal data.
        </label>
    </div>
    <p class="register-form-terms-error register-form-error">
        <?php echo getFieldError('terms'); ?>
    </p>
    <button type="submit" class="register-form-submit submit-btn">
        Log in
    </button>
</form>
