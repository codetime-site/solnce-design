<?php
// Константы для удобства
define('CONTACT', get_template_directory_uri() . '/contact/');
define('MY_ASSETS', get_template_directory_uri() . '/assets');

if(!defined("GET_ACF_TITLE"))
    define('GET_ACF_TITLE', 'templates/logic_section/send_title');




// Подключение стилей и скриптов
add_action('wp_enqueue_scripts', "reg_scripts");
function reg_scripts(){ get_template_part('inc/scripts');}

// Регистрация меню
add_action('after_setup_theme', 'reg_menu');
function reg_menu(){ get_template_part('inc/menu'); }

// хлебный крошка не готова пока 
get_template_part('inc/breadcrumbs');

// connect amocrm 
get_template_part('inc/amocrm');



// Исключаем категорию "Templates" из всех запросов товаров
add_action('pre_get_posts', 'exclude_templates_category');
function exclude_templates_category($query) {
    if (!is_admin() && $query->is_main_query()) {
        $templates_cat = get_term_by('slug', 'templates', 'category');
        if ($templates_cat) {
            $query->set('category__not_in', array($templates_cat->term_id));
        }
    }
}

// contact_form 7
add_action('wpcf7_mail_sent', function($contact_form){
    $submission = WPCF7_Submission::get_instance();
    if (!$submission) return;
    $data = $submission->get_posted_data();

    $name = sanitize_text_field($data['your-name'] ?? $data['names'] ?? $data['name'] ?? '');
    $phone = sanitize_text_field($data['your-phone'] ?? $data['phones'] ?? $data['phone'] ?? '');
    $email = sanitize_email($data['your-email'] ?? $data['emails'] ?? $data['email'] ?? '');
    $city = sanitize_text_field($data['your-city'] ?? $data['city'] ?? '');

    // Попробуем получить ссылку на товар — либо из скрытого поля, либо из REFERER
    $product_url = sanitize_text_field($data['product_url'] ?? ($_SERVER['HTTP_REFERER'] ?? ''));

    if ($phone) {
        $res = amocrm_create_lead_with_contact($name ?: 'Без имени', $phone, $email, $city, $product_url);
        if (is_wp_error($res)) error_log('amoCRM error: ' . $res->get_error_message());
        else error_log('amoCRM create lead response: ' . print_r($res, true));
    }
});


// cir_to_lat  for portfolio

get_template_part('inc/cir_to_lat');
get_template_part('test_amo_crem/send_hello');
                        