<?php
require '../settings.php';
// HEAD
require '../layouts/head.php';
?>

<body>
<!--Заголовок-->
<?php
require '../layouts/header.php';
?>

<main class="main">
    <!--Меню-->
    <?php
    require '../layouts/menu.php';
    ?>

    <section class="register">
        <div class="register-img">
            <img src="../assets/images/logo.png" alt="logo">
        </div>
        <h2 class="register-welcome">
            Welcome!
        </h2>
        <p class="register-text">
            Create a new account
        </p>
        <form action="login.php" method="post" class="login-form">
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
                    <option value="ua">
                        Ukraine
                    </option>
                    <option value="us">
                        USA
                    </option>
                    <option value="gb">
                        United Kingdom
                    </option>
                </select>
            </div>
            <div class="register-form-languages">
                <label for="languages">
                    Languages mastered:
                </label>
                <select id="languages" name="languages" multiple>
                    <option value="uk">
                        Ukraine
                    </option>
                    <option value="en">
                        English
                    </option>
                    <option value="fr">
                        France
                    </option>
                </select>
            </div>
            <div class="register-form-interests">
                <p>
                    Interests:
                </p>
                <label>
                    <input type="checkbox" name="interests" value="sports">
                    Sport
                </label>
                <label>
                    <input type="checkbox" name="interests" value="music">
                    Music
                </label>
                <label>
                    <input type="checkbox" name="interests" value="reading">
                    Reading
                </label>
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
        <p class="register-bottom-text">
            Do you have an account?
            <a href="login.php" class="register-login-link">
                Sign in
            </a>
        </p>
    </section>
</main>

<!--Подвал-->
<?php
require '../layouts/footer.php';
?>
</body>
