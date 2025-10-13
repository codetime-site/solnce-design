<!DOCTYPE html>
<html lang="<?php bloginfo('language'); ?>">

<head>
    <meta charset="<?php echo bloginfo("charset") ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo bloginfo("name") ?></title>
    <meta name="description" content="<?php echo bloginfo("description") ?>">
    <meta name="yandex-verification" content="abf78c10058774ca" />
    <?php wp_head(); ?>
</head>

<body>
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
        .breadcrumbs {
            max-width: 900px;
            margin: 0 auto;
            font-size: 0.95rem;
            color: #666;
        }

        .breadcrumbs-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        .breadcrumbs-list li {
            margin-right: 8px;
        }

        .breadcrumbs-list .separator {
            color: #999;
            margin-right: 8px;
        }

        .breadcrumbs-list a {
            color: #f9b233;
            text-decoration: none;
            transition: color 0.2s;
        }

        .breadcrumbs-list a:hover {
            color: #e89a0c;
        }

        .breadcrumbs-list span {
            color: #fdfdfdff;
            font-weight: 500;
        }
    </style>