<?php
require '../../settings.php';
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

        <?php
        require '../components/auth/login_form.php';
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
require '../layouts/footer.php';
?>
</body>