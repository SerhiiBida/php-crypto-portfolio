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