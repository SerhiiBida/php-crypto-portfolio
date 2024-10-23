<?php
require '../../settings.php';
// Обработчик формы добавления монет в портфель
require_once __DIR__ . '/../components/portfolio/add_coin_handler.php';
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

    <section class="portfolio">
        <?php
        require_once __DIR__ . '/../components/portfolio/add_coin_form.php';
        require_once __DIR__ . '/../components/portfolio/portfolio_coins.php';
        require_once __DIR__ . '/../components/portfolio/chart.php';
        ?>
    </section>
</main>

<!--Подвал-->
<?php
require '../layouts/footer.php';
?>
</body>