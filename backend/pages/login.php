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

    <section class="login">
        <div class="login-img">
            <img src="../assets/images/logo.png" alt="logo">
        </div>
        <h2 class="login-welcome">
            Welcome back!
        </h2>
        <p class="login-text">
            Log into your account
        </p>
        <form action="login.php" method="post" class="login-form">
            <div class="login-form-email custom-input-wrapper">
                <label for="email" class="login-form-email-label custom-input-label">
                    Email
                </label>
                <input
                        type="email"
                        name="email"
                        id="email"
                        placeholder="food@gmail.com"
                        class="login-form-email-input custom-input"
                        maxlength="254"
                        required
                >
                <p class="login-form-email-error custom-input-error"></p>
            </div>
            <div class="login-form-password custom-input-wrapper">
                <label for="password" class="login-form-password-label custom-input-label">
                    Password
                </label>
                <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="********"
                        class="login-form-password-input custom-input"
                        minlength="8"
                        maxlength="16"
                        required
                >
                <p class="login-form-password-error custom-input-error"></p>
            </div>
            <button type="submit" class="login-form-submit submit-btn">
                Log in
            </button>
        </form>
        <p class="login-bottom-text">
            Don't have an account?
            <a href="register.php" class="login-register-link">
                Sign up
            </a>
        </p>
    </section>
</main>

<!--Подвал-->
<?php
require '../layouts/footer.php';
?>
</body>