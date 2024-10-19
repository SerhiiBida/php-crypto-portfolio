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

    <section class="portfolios">
        <div class="portfolios-form-wrapper">
            <h2 class="portfolios-form-title">
                Portfolios
            </h2>
            <p class="portfolios-form-text">
                Or
            </p>
            <?php
            require __DIR__ . '/../components/portfolios/add_portfolio_form.php'
            ?>
        </div>
    </section>
</main>

<!--Подвал-->
<?php
require '../layouts/footer.php';
?>
</body>

