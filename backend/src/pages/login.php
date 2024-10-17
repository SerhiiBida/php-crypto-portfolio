<?php
require __DIR__ . '/../../settings.php';

// Обработка формы
require __DIR__ . '/../components/auth/login_handler.php';

// HEAD
require __DIR__ . '/../layouts/head.php';
?>

<body>
<!--Заголовок-->
<?php
require __DIR__ . '/../layouts/header.php';
?>

<main class="main">
    <!--Меню-->
    <?php
    require __DIR__ . '/../layouts/menu.php';
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

        <?php
        require __DIR__ . '/../components/auth/login_form.php';
        ?>

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
require __DIR__ . '/../layouts/footer.php';
?>
</body>