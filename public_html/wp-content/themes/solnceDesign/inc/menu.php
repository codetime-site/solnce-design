<?php

// Регистрация меню
add_action('after_setup_theme', 'reg_menu');
function reg_menu()
{
    register_nav_menus([
        'header_menu' => 'Меню в шапке',
        'footer_menu' => 'Меню в подвале',
    ]);
}