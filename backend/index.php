<?php
require 'settings.php';
require 'layouts/head.php';
require 'layouts/header.php';
require 'layouts/menu.php';
require 'layouts/footer.php';
?>

<!--HEAD-->
<?php includeHead(); ?>

<body>
<!--Заголовок-->
<?php includeHeader(); ?>

<main class="main">
    <!--Меню-->
    <?php includeMenu(); ?>

    <section class="welcome">
        <h1 class="welcome-title">
            Welcome
        </h1>
    </section>
</main>

<!--Подвал-->
<?php includeFooter(); ?>
</body>
