// МЕНЮ:
// Открытие и закрытие меню
const buttonBurger = document.querySelector(".header-burger");
const menu = document.querySelector(".menu");
const menuMobileBackground = document.querySelector(".menu-mobile-background");

const changeShowMenu = () => {
    menu.classList.toggle("show");
    menuMobileBackground.classList.toggle("show");
};

buttonBurger.addEventListener("click", changeShowMenu);

// Cкрыть меню на телефоне
menuMobileBackground.addEventListener("click", changeShowMenu);