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
    // get_template_part('inc/scripts');
    require_once get_template_directory() . '/inc/scripts.php';
}

// Регистрация меню
add_action('after_setup_theme', 'reg_menu');
function reg_menu()
{
    get_template_part('inc/menu');
}

// хлебный крошка не готова пока 
get_template_part('inc/breadcrumbs');

// require_once get_template_directory() . '/inc/tag_cf7.php';

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

// require_once get_template_directory() . '/amoCrm/start_amo.php';

// add_action('wpcf7_mail_sent', 'send_selected_cf7_to_amocrm');



require_once get_template_directory() . '/amoCrm_ver_2/start_amo.php';






add_filter('wpcf7_form_tag', function ($tag) {
    // Проверяем, что у тега есть имя (совместимость с разными версиями CF7)
    if (empty($tag['name'])) {
        return $tag;
    }

    // Получаем ID текущего поста (страницы/товара)
    $post_id = get_the_ID();

    // Обработаем нужные нам поля по имени
    if ($tag['name'] === 'acf_title') {
        // Используем get_sub_field, т.к. у тебя так работало
        $acf_value = function_exists('get_sub_field') ? get_sub_field('title') : null;
        $tag['values'] = [$acf_value ?: 'Заголовок по умолчанию'];
    }
    if ($tag['name'] === 'acf_sub_title') {
        $acf_value = function_exists('get_sub_field') ? get_sub_field('rec_sub_title') : null;

        $tag['values'] = [$acf_value ?: 'Заголовок по умолчанию'];
    }
    if ($tag['name'] === 'acf_link') {
        $permalink = $post_id ? get_permalink($post_id) : home_url('/');
        $tag['values'] = [esc_url_raw($permalink)];
    }

    if ($tag['name'] === 'acf_image') {
        $post_id = get_the_ID();

        // Пытаемся получить изображение из ACF
   
        // $image = get_field('back_img', $post_id) ?: get_field('img', $post_id);
        $image = get_sub_field('back_img',$post_id) ?: get_field('img',$post_id);

        // Преобразуем в URL, если это массив или ID
        if (is_array($image) && isset($image['url'])) {
            $image = $image['url'];
        } elseif (is_numeric($image)) {
            $image = wp_get_attachment_url($image);
        }

        // Подставляем значение
        $tag['values'] = [$image ?: '/'];
        // $tag['values'] = [$image['url'] ?: '/'];
    }

    return $tag;
});
