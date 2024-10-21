<?php

use App\database\tables\Portfolios;

require '../../settings.php';
// Обработка формы изменения портфеля
require __DIR__ . '/../components/portfolios/change_portfolio_handler.php';
// Обработка формы добавления портфеля
require __DIR__ . '/../components/portfolios/add_portfolio_handler.php';
// Отображение ошибок и старых данных
require __DIR__ . '/../utils/form/display_data.php';
require __DIR__ . '/../utils/form/display_errors.php';
// HEAD
require '../layouts/head.php';
?>

<body>
<?php
// Данные про доступные портфели
$portfoliosObj = new Portfolios();

$userId = $_SESSION['userId'];

$portfolio = $portfoliosObj->getAllByUser($userId);

if (is_null($portfolio)) {
    $portfolio = [];
}
?>

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
            <?php if ($_SESSION['auth']): ?>
                <div class="portfolios-form-change-names">
                    <?php ?>
                    <?php ?>
                </div>
            <?php endif; ?>
            <?php
            require __DIR__ . '/../components/portfolios/change_portfolio_form.php';
            ?>
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

