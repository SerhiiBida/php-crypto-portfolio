<?php
require './settings.php';
// HEAD
require './src/layouts/head.php';
?>

<body>
<!--Заголовок-->
<?php
require './src/layouts/header.php';
?>

<main class="main">
    <!--Меню-->
    <?php
    require './src/layouts/menu.php';
    ?>

    <section class="welcome">
        <div class="welcome-img">
            <img src="./src/assets/images/logo.png" alt="logo">
        </div>
        <h1 class="welcome-title">
            Crypto Portfolio
        </h1>
        <p class="welcome-text">
            Start now
        </p>
        <a href="./src/pages/login.php" class="welcome-button submit-btn">
            Log in
        </a>
    </section>
</main>

<!--Подвал-->
<?php
require './src/layouts/footer.php';
?>
</body>
