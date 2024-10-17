<?php
require '../../settings.php';

// Обработчик формы
require __DIR__ . '/../components/auth/register_handler.php';

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

        <?php
        require '../components/auth/register_form.php';
        ?>

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
