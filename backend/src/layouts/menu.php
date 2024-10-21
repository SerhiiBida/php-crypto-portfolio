<?php

use App\database\tables\Portfolios;

$portfoliosData = [];

// Данные про портфели пользователя
if (!empty($_COOKIE['auth'])) {
    $portfoliosObj = new Portfolios();

    $portfoliosData = $portfoliosObj->getAllByUser($_SESSION['userId']);

    if (is_null($portfoliosData)) {
        $portfoliosData = [];
    }
}
?>
<!--Меню-->
<div class="menu-mobile-background show"></div>
<nav class="menu show">
    <ol class="menu-list">
        <?php if (empty($_COOKIE['auth'])): ?>
            <a href="/src/pages/login.php" class="menu-item">
                <span class="material-symbols-outlined opacity-60">
                    login
                </span>
                Login / Register
            </a>
        <?php else: ?>
            <a href="/src/pages/portfolios.php" class="menu-item">
                <span class="material-symbols-outlined opacity-60">
                    deployed_code
                </span>
                Portfolios
            </a>
            <!--Вывод портфелей пользователя-->
            <?php foreach ($portfoliosData as $portfolio): ?>
                <a
                        href="/src/pages/portfolio.php?page-id=<?php echo $portfolio['id']; ?>"
                        class="menu-item"
                >
                    <span class="material-symbols-outlined opacity-60">
                        work
                    </span>
                    <?php echo $portfolio['name'] ?>
                </a>
            <?php endforeach; ?>
            <div class="menu-bottom">
                <a href="/src/pages/logout.php" class="menu-logout-link">
                    <button class="submit-btn menu-logout-button">
                        Logout
                    </button>
                </a>
            </div>
        <?php endif; ?>
    </ol>
</nav>