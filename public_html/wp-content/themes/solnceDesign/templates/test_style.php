<header class="header" id="header">
    <div class="container">
        <div class="header__content">
            <div class="header__mobile">
                <div class="hamburger" id="hamburger">
                    <span></span> <span></span> <span></span>
                </div>
            </div>

            <div class="header__logo">
                <a href="/">
                    <?php get_template_part('templates/contacts/logo_white'); ?>
                </a>
                <?php get_template_part('templates/contacts/under_logo'); ?>
            </div>
            <?php
            wp_nav_menu([
                'theme_location' => 'header_menu',
                'container' => 'nav',
                'container_class' => 'header__menu menu',
                'container_id' => 'header__menu',
                'menu_class' => 'menu',
                'echo' => true,
                'items_wrap' => '<ul id="%1$s" class="menu__list %2$s">%3$s</ul>',
                'depth' => 1,
                'walker' => '',
            ]) ?>
            <?php get_template_part('templates/contacts/callme'); ?>
        </div>
    </div>
    <?php  //echo custom_breadcrumbs(); ?>
</header>

<style>
    /* Общие */
    header {
        background: linear-gradient(116deg, #0a0a0a, rgba(87, 70, 70, 0.671), rgba(0, 0, 0, 0.788));
        position: fixed;
        top: 0;
        left: 0;
        z-index: 100;
        width: 100%;
    }

    /* Отступ */
    .header__content {
        display: flex;
        column-gap: 47px;
        justify-content: center;
        align-items: center;
        padding: 16px;
    }

    /* Мобильный */
    .header__mobile {
        display: flex;
        display: none;
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
        width: 208px;
        height: auto;
    }

    /* Середина */
    .header__menu .menu__list {
        display: flex;
        gap: 4px;
        align-items: center;
        padding: 12px 8px;
        list-style: none;
        /* Добавлено для корректности списка */
        margin: 0;
        /* Добавлено для корректности списка */
    }

    .header__menu .menu-item {
        transition: all 0.2s;
        padding: 5px 20px;
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

    /* Стили для мобильных устройств (конвертация +below(t) в @media) */
    @media only screen and (max-width: 768px) {
        .header__content {
            flex-direction: column;
            align-items: flex-start;
            padding: 10px 15px;
            position: relative;
        }

        .header__logo {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        svg#logo {
            width: 150px;
        }

        .header__logo p {
            font-size: 0.8em;
            margin-top: 5px;
        }

        .header__menu {
            width: 100%;
            position: relative;
            z-index: 100;
        }

        .header__menu .menu__list {
            display: none;
            flex-direction: column;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: #0a0a0a;
            padding: 10px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        }

        .header__menu .menu__list.active {
            display: flex;
        }

        .header__menu .menu-item {
            padding: 10px 15px;
            text-align: center;
            width: 100%;
            border-radius: 5px;
            margin: 2px 0;
        }

        .header__menu .menu-item:hover {
            background: #fe4f18;
            /* Заменено var(--main_sun) на #fe4f18 */
            border-radius: 5px;
        }

        .header__menu .current-menu-item {
            background: #fe4f18;
            /* Применено для активного пункта */
            border-radius: 5px;
        }

        .header__callme {
            width: 100%;
            justify-content: center;
            margin-top: 10px;
        }

        .callme__right {
            width: auto;
            text-align: center;
        }

        .callme__right>a {
            font-size: 0.9em;
        }

        /* Мобильный гамбургер и контейнер */
        .header__mobile {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            width: 100%;
            padding: 10px 0;
            position: absolute;
            /* Позиционирование из ваших стилей */
            top: 15px;
            right: 15px;
        }

        .hamburger {
            display: block;
            width: 30px;
            height: 20px;
            position: relative;
            cursor: pointer;
        }

        .hamburger span {
            display: block;
            height: 3px;
            background: #fff;
            margin-bottom: 5px;
            transition: all 0.3s;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -7px);
        }
    }

    /* Дополнительные медиа-запросы для лучшей адаптивности */
    @media only screen and (max-width: 480px) {
        .header__content {
            padding: 5px 10px;
        }

        svg#logo {
            width: 120px;
        }

        .header__logo p {
            font-size: 0.7em;
        }

        .header__mobile {
            top: 10px;
            right: 10px;
        }

        .hamburger {
            width: 25px;
            height: 18px;
        }

        .callme__right>a {
            font-size: 0.8em;
        }
    }

    /* Скрываем гамбургер на десктопе, если он был показан мобильными стилями */
    @media only screen and (min-width: 769px) {
        .header__mobile {
            display: none;
        }
    }
</style>