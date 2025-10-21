<?php
// Константы для удобства
define('CONTACT', get_template_directory_uri() . '/contact/');
define('MY_ASSETS', get_template_directory_uri() . '/assets');

if (!defined("GET_ACF_TITLE"))
    define('GET_ACF_TITLE', 'templates/logic_section/send_title');




// Подключение стилей и скриптов
add_action('wp_enqueue_scripts', "reg_scripts");
function reg_scripts()
{
    get_template_part('inc/scripts');
}

// Регистрация меню
add_action('after_setup_theme', 'reg_menu');
function reg_menu()
{
    get_template_part('inc/menu');
}

// хлебный крошка не готова пока 
get_template_part('inc/breadcrumbs');

// connect amocrm 
// get_template_part('inc/amocrm');



// Исключаем категорию "Templates" из всех запросов товаров
add_action('pre_get_posts', 'exclude_templates_category');
function exclude_templates_category($query)
{
    if (!is_admin() && $query->is_main_query()) {
        $templates_cat = get_term_by('slug', 'templates', 'category');
        if ($templates_cat) {
            $query->set('category__not_in', array($templates_cat->term_id));
        }
    }
}

get_template_part('inc/cir_to_lat');
// get_template_part('test_amo_crem/send_hello');

require_once get_template_directory() . '/test_amo_crem/send_test_message.php';


// require_once get_template_directory() . '/test_amo_crem/lesson_1_send_hello_world.php';