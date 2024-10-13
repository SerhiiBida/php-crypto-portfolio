// Контент
const main = document.querySelector('.main');

// Отступ по умолчанию при открытом меню
main.classList.add('main-ml-256');

// МЕНЮ:
// Открытие и закрытие меню
const buttonBurger = document.querySelector(".header-burger");
const menu = document.querySelector(".menu");
const menuMobileBackground = document.querySelector(".menu-mobile-background");

const changeShowMenu = () => {
    menu.classList.toggle("show");
    menuMobileBackground.classList.toggle("show");
    main.classList.toggle("main-ml-256");
};

buttonBurger.addEventListener("click", changeShowMenu);

// Cкрыть меню на телефоне
menuMobileBackground.addEventListener("click", changeShowMenu);