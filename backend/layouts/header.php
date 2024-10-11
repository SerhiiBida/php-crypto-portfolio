<?php
// Заголовок страницы
function includeHeader(): void
{
    echo '<header class="header">
            <div class="header-burger">
                <span class="header-burger-line"></span>
                <span class="header-burger-line"></span>
                <span class="header-burger-line"></span>
            </div>
            <h3 class="header-title">
                Crypto Portfolio
            </h3>
        </header>';
}