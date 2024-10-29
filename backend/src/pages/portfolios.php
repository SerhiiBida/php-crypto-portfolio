<?php

use App\database\tables\Portfolios;

require '../../settings.php';
// Обработка формы изменения портфеля
require __DIR__ . '/../components/portfolios/handlers/change_portfolio_handler.php';
// Обработка формы добавления портфеля
require __DIR__ . '/../components/portfolios/handlers/add_portfolio_handler.php';
// HEAD
require '../layouts/head.php';
?>

<body>
<?php
// Данные про доступные портфели
$portfoliosObj = new Portfolios();

$userId = $_SESSION['userId'];

$portfolios = $portfoliosObj->getAllByUser($userId);

if (is_null($portfolios)) {
    $portfolios = [];
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
            <?php if ($portfolios): ?>
                <div class="portfolios-form-change-names">
                    <?php
                    // Формы изменения
                    foreach ($portfolios as $portfolio) {
                        $portfolioId = $portfolio['id'];
                        $portfolioName = $portfolio['name'];

                        require __DIR__ . '/../components/portfolios/forms/change_portfolio_form.php';
                    }
                    ?>
                </div>
            <?php endif; ?>
            <?php if (count($portfolios) > 0 && count($portfolios) < 6): ?>
                <p class="portfolios-form-text">
                    Or
                </p>
            <?php endif; ?>
            <?php
            // Форма добавления
            if (count($portfolios) < 6) {
                require __DIR__ . '/../components/portfolios/forms/add_portfolio_form.php';
            }
            ?>
        </div>
    </section>
</main>

<!--Подвал-->
<?php
require '../layouts/footer.php';
?>
</body>

