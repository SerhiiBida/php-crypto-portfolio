<?php
require 'settings.php';
// HEAD
require 'layouts/head.php';
?>

<body>
<!--Заголовок-->
<?php
require 'layouts/header.php';
?>

<main class="main">
    <!--Меню-->
    <?php
    require 'layouts/menu.php';
    ?>

    <section class="welcome">
        <div class="welcome-img">
            <img src="./assets/images/logo.png" alt="logo">
        </div>
        <h1 class="welcome-title">
            Crypto Portfolio
        </h1>
        <p class="welcome-text">
            Start now
        </p>
        <a href="pages/login.php" class="welcome-button submit-btn">
            Log in
        </a>
    </section>
</main>

<!--Подвал-->
<?php
require 'layouts/footer.php';
?>
</body>
