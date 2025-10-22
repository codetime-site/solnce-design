<?php

// ✅разделяй и властвуй  
// Запуск скрипта в среде WordPress (Рекомендуется, если нужны функции WP
require_once('../../../../wp-load.php');


//     // 🔧 Настройки amoCRM для подключение 
require_once get_template_directory() . "/amoCrm/setting_amo.php";
require_once get_template_directory() . "/amoCrm/get_contact_form_date.php";
require_once get_template_directory() . "/amoCrm/send_contact_form_date.php";
require_once get_template_directory() . "/amoCrm/creat_leads.php";







// =======================================
// 💬 Интеграция Contact Form 7 → amoCRM
// =======================================

// Подключаем хук Contact Form 7
// add_action('wpcf7_mail_sent', 'send_selected_cf7_to_amocrm');

// function send_selected_cf7_to_amocrm($contact_form)
// {
//     // === Данные клиента  от contact form 7 и контактный данный
//     // require_once get_template_directory() . "/amoCrm/get_contact_form_date.php";

//     $allowed_form_id = 337;
//     $form_id = $contact_form->id();
//     if ($form_id != $allowed_form_id)
//         return;

//     // 🔹 Получаем данные формы
//     $submission = WPCF7_Submission::get_instance();
//     if (!$submission)
//         return;
//     $data = $submission->get_posted_data();

//     $client_name = sanitize_text_field($data['names'] ?? 'Без имени');
//     $address = sanitize_text_field($data['city'] ?? 'Не указан город');
//     $client_phone = sanitize_text_field($data['phones'] ?? 'Без телефона');

//     // 🔹 Информация о сайте и странице
//     $product_name = get_bloginfo('name'); // имя сайта
//     $page_title = function_exists('get_the_title') ? get_the_title() : 'Страница без названия';



//     // 🔧 Настройки amoCRM для подключение 
//     // require_once get_template_directory() . "/amoCrm/setting_amo.php";

//     // === Настройки ===
//     $subdomain = 'shadoof'; // твой поддомен AmoCRM
//     $pipeline_id = 6967578; // ID воронки
//     $status_id = 58548442;   // например, "Первичный контакт"
//     // $amo_field_name = 1800461; // кастомный поля

//     // Загружаем токены из файла
//     $tokensFile = '/var/www/fastuser/data/www/solnce-design.ru/public_html/amocrm_tokens.json';
//     if (!file_exists($tokensFile)) {
//         exit('❌ Файл токенов не найден. Сначала нужно авторизоваться.');
//     } else {
//         echo "✅  Файл токенов найден\n";
//     }

//     // json_decode() — это встроенная функция PHP, которая
//     //  используется для преобразования строки, закодированной в 
//     // формате JSON (JavaScript Object Notation), обратно 
//     // в нативные структуры данных PHP.
//     $tokens = json_decode(file_get_contents($tokensFile), true);
//     $access_token = $tokens['access_token'];

//     // === ШАГ 1. Создаём контакт ===
//     require_once get_template_directory() . "/amoCrm/send_contact_form_date.php";

//     // === ШАГ 2. Создаём сделку и привязываем контакт ===
//     // require_once get_template_directory() . "/amoCrm/creat_leads.php";
// }





