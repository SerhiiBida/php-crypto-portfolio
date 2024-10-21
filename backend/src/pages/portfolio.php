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

    <section class="portfolio">
        <h1>
            <?php echo $_GET['page-id'] ?>
        </h1>
    </section>
</main>

<!--Подвал-->
<?php
require '../layouts/footer.php';
?>
</body>