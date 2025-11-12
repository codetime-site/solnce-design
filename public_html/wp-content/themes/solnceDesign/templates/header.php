<?php  //get_template_part('templates/test_style'); ?>








<header class="header" id="header">
    <div class="container">
        <div class="header__section">
            <div class="header__top">
                <div class="header__logo">
                    <a href="/">
                        <?php get_template_part('templates/contacts/logo_white'); ?>
                    </a>
                    <?php get_template_part('templates/contacts/under_logo'); ?>
                </div>

                <button class="menu-toggle" aria-controls="mobileMenu" aria-expanded="false">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
                <div class="header__contact">
                    <?php get_template_part('templates/contacts/callme'); ?>
                </div>
            </div>
            <?php
            wp_nav_menu([
                'theme_location' => 'header_menu',
                'container' => 'nav',
                'container_class' => 'header__menu menu',
                'container_id' => 'mobileMenu',
                'menu_class' => 'menu',
                'echo' => true,
                'items_wrap' => '<ul id="%1$s" class="header__list %2$s">%3$s</ul>',
                'depth' => 1,
                'walker' => '',
            ]) ?>
        </div>
    </div>
</header>

<style>
    .header {
        position: sticky;
        top: 0;
        background-color: #3a3434ff;
        width: 100%;
        padding: 15px 0;
        border-bottom: 1px solid #e0e0e0;
        z-index: 100;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .header__menu .menu-item:hover {
        background: #fe4f18;
        /* Заменено clr(sun) на #fe4f18 */
        border-radius: 5px;
    }

    .header__menu .current-menu-item {
        background: #fe4f18;
        /* Заменено clr(sun) на #fe4f18 */
        border-radius: 5px;
    }

    .header__top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 4px;
    }

    .header__logo img {
        height: 50px;
        display: block;
    }

    /* Левая часть */
    .header__logo {
        text-align: center;
    }

    .header__logo p {
        text-align: center;
        font-size: 0.7em;
    }

    svg#logo {
        width: 180px;
        height: auto;
    }

    .header__contact a {
        text-decoration: none;
        font-size: .8em;
        font-weight: bold;
        transition: color 0.3s;
    }

    .header__menu {
        text-align: center;
    }

    .header__list {
        list-style: none;
        padding: 4px;
        margin: 0;
        display: flex;
        justify-content: center;
        gap: 30px;
    }



    li.menu-item {
        padding: 5px;
    }

    .header__link {
        text-decoration: none;
        color: #f0f0f0ff;
        font-size: 18px;
        padding: 5px 10px;
        transition: color 0.3s;
        display: block;
    }

    .header__link:hover {
        color: #007bff;
    }

    /* Кнопка-гамбургер: по умолчанию скрыта на десктопе */
    .menu-toggle {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
        padding: 10px;
        z-index: 101;
        line-height: 0;
    }

    /* Полоски гамбургера */
    .bar {
        display: block;
        width: 25px;
        height: 3px;
        margin: 4px 0;
        background-color: #ffffffff;
        transition: 0.4s;
        /* ОБЯЗАТЕЛЬНО ДЛЯ ПЛАВНОЙ АНИМАЦИИ */
        border-radius: 2px;
    }

    /* ------------------------------------------------------------------- */
    /* 2. АНИМАЦИЯ ГАМБУРГЕРА В КРЕСТИК */
    /* ------------------------------------------------------------------- */

    /* 1. Верхняя полоска: Поворот и сдвиг вниз */
    .menu-toggle.is-open .bar:nth-child(1) {
        transform: translateY(7px) rotate(45deg);
    }

    /* 2. Средняя полоска: Скрытие */
    .menu-toggle.is-open .bar:nth-child(2) {
        opacity: 0;
    }

    /* 3. Нижняя полоска: Поворот и сдвиг вверх */
    .menu-toggle.is-open .bar:nth-child(3) {
        transform: translateY(-7px) rotate(-45deg);
    }


    /* Правая часть */
    .header__callme {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .header__callme .btn {
        border-radius: 5px;
        padding: 8px 10px;
    }

    .callme__right {
        width: 166px;
    }

    .callme__right>a {
        display: block;
    }

    /* ------------------------------------------------------------------- */
    /* 3. АДАПТАЦИЯ ДЛЯ МОБИЛЬНЫХ УСТРОЙСТВ */
    /* ------------------------------------------------------------------- */

    @media (max-width: 768px) {
        .header {
            padding: 10px 0;
        }

        .header__top {
            margin-bottom: 0;
        }

        .header__contact {
            display: none;
        }

        /* Скрываем контакт на мобильных */

        .menu-toggle {
            display: block;
        }

        /* Показываем кнопку-гамбургер */

        .header__menu {
            display: none;
            /* Скрыто по умолчанию */
            position: absolute;
            top: 102px;
            left: 0;
            width: 100%;
            background-color: #555555;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 0;
            margin-top: 0;
        }

        /* Класс, который показывает меню */
        .header__menu.is-open {
            display: block;
        }

        .header__list {
            flex-direction: column;
            gap: 0;
            align-items: flex-start;
        }

        .header__item {
            width: 100%;
            border-bottom: 1px solid #e0e0e0;
        }

        .header__item:last-child {
            border-bottom: none;
        }

        .header__link {
            padding: 12px 20px;
            text-align: left;
            font-size: 16px;
        }
    }

    /* ... (Ваши другие стили) ... */

    /* Стили для ссылок меню */
    .header__link {
        text-decoration: none;
        color: #343a40;
        /* Стандартный цвет текста */
        font-size: 18px;
        padding: 5px 10px;
        transition: color 0.3s;
        /* Обеспечивает плавное "свечение" при наведении */
        display: block;
    }

    /* Эффект "свечения" при наведении (hover) */
    .header__link:hover {
        color: #ff6a00;
        /* Яркий оранжевый цвет при наведении */
    }

    /* ------------------------------------------------------------------- */
    /* 2. СТИЛЬ ДЛЯ АКТИВНОГО (ВЫБРАННОГО) ПУНКТА МЕНЮ */
    /* ------------------------------------------------------------------- */

    .header__link.is-active {
        color: #ff6a00;
        /* Оранжевый цвет для выбранного пункта */
        font-weight: bold;
        /* Можно добавить выделение жирным */
    }

    /* ------------------------------------------------------------------- */
    /* ... (Ваши медиа-запросы и анимация гамбургера) ... */
</style>
 
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const menuToggle = document.querySelector(".menu-toggle");
        const mobileMenu = document.getElementById("mobileMenu");

        menuToggle.addEventListener("click", () => {
            const isExpanded =
                menuToggle.getAttribute("aria-expanded") === "true" || false;

            // Переключение атрибутов
            menuToggle.setAttribute("aria-expanded", !isExpanded);

            // !!! ЭТОТ ШАГ ВАЖЕН ДЛЯ АНИМАЦИИ ГАМБУРГЕРА:
            // Добавляем класс 'is-open' на САМУ кнопку
            menuToggle.classList.toggle("is-open");

            // Добавляем класс 'is-open' на меню
            mobileMenu.classList.toggle("is-open");
        });
    });

</script> 