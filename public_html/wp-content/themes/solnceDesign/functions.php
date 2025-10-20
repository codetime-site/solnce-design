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



// var_dump($contact_form->id());

// cir_to_lat  for portfolio

get_template_part('inc/cir_to_lat');
// get_template_part('test_amo_crem/send_hello');
// get_template_part('test_amo_crem/test_form_1');






// =======================================
// 💬 Простая интеграция Contact Form 7 → amoCRM
// =======================================

// 🔧 Настройки amoCRM
$subdomain = 'shadoof';
$apiUrl = "https://{$subdomain}.amocrm.ru/api/v4"; // <== ВОТ ЭТО ОБЯЗАТЕЛЬНО НУЖНО
$access_token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImE3NTZmMjg3ZDIyMWQ5MTA3NjNjYjk3MDgxZmI3OTFmYTUxOGVhZTk2MTIwMDlmMWVlZjdmZDhhMWJkYzhiOTMwOTk4ZTYzMGRhZjMzNDJjIn0.eyJhdWQiOiJmZjZmMjlmMy02NjJkLTRiNzYtYTBlYy03YTc1OTRiYTE0YTYiLCJqdGkiOiJhNzU2ZjI4N2QyMjFkOTEwNzYzY2I5NzA4MWZiNzkxZmE1MThlYWU5NjEyMDA5ZjFlZWY3ZmQ4YTFiZGM4YjkzMDk5OGU2MzBkYWYzMzQyYyIsImlhdCI6MTc2MDY2NTIwOCwibmJmIjoxNzYwNjY1MjA4LCJleHAiOjE3Njg2OTQ0MDAsInN1YiI6IjEyOTQ1MjQyIiwiZ3JhbnRfdHlwZSI6IiIsImFjY291bnRfaWQiOjMxMTQ5Njc4LCJiYXNlX2RvbWFpbiI6ImFtb2NybS5ydSIsInZlcnNpb24iOjIsInNjb3BlcyI6WyJjcm0iXSwidXNlcl9mbGFncyI6MCwiaGFzaF91dWlkIjoiMWY0YmU2ZjMtY2U3MC00Y2FmLTg2NmUtNzkyY2VkMjQxMGNmIiwiYXBpX2RvbWFpbiI6ImFwaS1iLmFtb2NybS5ydSJ9.LkmdagndnsQyxJxheXtc-ICntn57M34BDxw4BVwMuJYOCbEpKAmIpJ1e0xfkgf8GtHT1CkLzSerq9-sJ0Ji-uiq28nRCToy6OjYjl6ZC2wTgcJ9H-gGKQbv_quYCQUgnhaapCaeGCvSKeBgEfaw5xAyuUyvwWKP58Y8S-J99L6FWBpLZ2RUSvyqBWqFWKaaG0fWSGNVW3TR2KIFXB_PLD8XdVlMRf2K_CniRbBEWL_hFLIlOO5Ye8G2Zq2zGu9K8tx2MUKMfOVUUCy3hmgEcT7G0mqgHbNKLSv_8K3Jsmi_ydNXv_Q2w1LzvYe9WAM3-QPyejvJsYHjVbtCFlx_HZA";

// Список ID форм, которые будут отправлять данные в amoCRM
$allowed_forms = [
    8 // замените на реальные числовые ID форм
];

// Подключаем хук на отправку формы
add_action('wpcf7_mail_sent', 'send_selected_cf7_to_amocrm');

function send_selected_cf7_to_amocrm($contact_form) {
    global $apiUrl, $access_token, $allowed_forms;

    // Проверяем, что форма в списке разрешённых
    $form_id = $contact_form->id();
    if (!in_array($form_id, $allowed_forms)) return;

    // Получаем данные формы
    $submission = WPCF7_Submission::get_instance();
    if (!$submission) return;
    $data = $submission->get_posted_data();

    // 🔹 Берём поля формы
    $name  = sanitize_text_field($data['names'] ?? 'Без имени');
    $city  = sanitize_text_field($data['city'] ?? 'Не указан город');
    $phone = sanitize_text_field($data['phones'] ?? 'Без телефона');

    // 🔹 Дополнительная информация (например, название страницы или товара)
    $product_name = function_exists('get_the_title') ? get_the_title() : 'solnce-design';

    // 🔹 Формируем массив для complex endpoint
    $leadData = [
        'add' => [
            [
                'name' => "Заявка с сайта: $product_name",
                'tags' => ['Сайт'], // можно добавить свои теги
                '_embedded' => [
                    'contacts' => [
                        [
                            'first_name' => $name,
                            'custom_fields_values' => [
                                [
                                    'field_code' => 'PHONE',
                                    'values' => [['value' => $phone, 'enum_code' => 'WORK']]
                                ],
                                [
                                    'field_code' => 'CITY', // поле "Город" в amoCRM
                                    'values' => [['value' => $city]]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ];

    // 🔹 Отправляем в amoCRM
    $ch = curl_init("$apiUrl/leads/complex");
    curl_setopt_array($ch, [
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer $access_token",
            "Content-Type: application/json"
        ],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($leadData, JSON_UNESCAPED_UNICODE)
    ]);

    $response = curl_exec($ch);
    $error = curl_error($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // 🔹 Логируем результат
    if ($error) {
        error_log("❌ Ошибка cURL: $error");
    } else {
        error_log("✅ Отправлено в AmoCRM ($code): $response");
    }
}
?>
