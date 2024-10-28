// Контент
const main = document.querySelector('.main');

// МЕНЮ:
// Открытие и закрытие меню
const buttonBurger = document.querySelector(".header-burger");
const menu = document.querySelector(".menu");
const menuMobileBackground = document.querySelector(".menu-mobile-background");

const changeShowMenu = () => {
    menu.classList.toggle("show");
    menuMobileBackground.classList.toggle("show");
    main.classList.toggle("main-ml-256");

    $menuShow = menu.classList.contains("show") ? "true" : "false";

    localStorage.setItem("menuShow", $menuShow);
};

buttonBurger.addEventListener("click", changeShowMenu);

// Cкрыть меню на телефоне
menuMobileBackground.addEventListener("click", changeShowMenu);

// Открытое меню в зависимости от последнего выбора пользователя
if (localStorage.getItem('menuShow') !== null) {
    $menuShow = localStorage.getItem('menuShow');

    if ($menuShow === "true") {
        changeShowMenu();
    }

} else {
    changeShowMenu();
}