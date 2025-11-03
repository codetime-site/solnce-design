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
    require get_template_directory() . '/inc/scripts.php';
}

// add_action('wp_footer', function () {
//     // require get_template_directory() . '/inc/footer_script.php';

//     $map1 = get_query_var('maps_1');
//     $map2 = get_query_var('maps_2');

//     if ($map1 || $map2) {
//         // Проверяем, зарегистрирован ли скрипт
//         if (wp_script_is('some_scripts', 'registered') || wp_script_is('some_scripts', 'enqueued')) {
//             wp_localize_script('some_scripts', 'wpMaps', [
//                 'maps_1' => $map1,
//                 'maps_2' => $map2,
//             ]);
//         }
//     }

// }, 20);


// Регистрация меню
add_action('after_setup_theme', 'reg_menu');
function reg_menu()
{
    get_template_part('inc/menu');
}

// хлебный крошка не готова пока 
get_template_part('inc/breadcrumbs');

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

// require_once get_template_directory() . '/inc/catalog_filter.php';


// print('hello');






add_filter('wpcf7_form_tag', function ($tag) {
    // Проверяем, что у тега есть имя (совместимость с разными версиями CF7)
    if (empty($tag['name'])) {
        return $tag;
    }


    // Получаем ID текущего поста (страницы/товара)
    $post_id = get_the_ID();

    if (!empty($tag['name']) && $tag['name'] === 'product_id') {
        $post_id = get_the_ID();
        if ($post_id) {
            $tag['values'] = [$post_id];
        }
    }
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
        $image = get_sub_field('back_img', $post_id) ?: get_field('img', $post_id);

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



add_action('wp_ajax_upload_canvas', 'upload_canvas');
add_action('wp_ajax_nopriv_upload_canvas', 'upload_canvas');

function upload_canvas()
{
    if (empty($_FILES['canvas_image']))
        wp_send_json_error('No file');

    $file = $_FILES['canvas_image'];
    $upload = wp_handle_upload($file, ['test_form' => false]);

    if (isset($upload['url'])) {
        wp_send_json_success(['url' => $upload['url']]);
    } else {
        wp_send_json_error('Upload failed');
    }
}
