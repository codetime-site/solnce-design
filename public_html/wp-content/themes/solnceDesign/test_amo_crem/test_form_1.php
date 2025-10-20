<?php
// =======================================
// 💬 Простая интеграция Contact Form 7 → amoCRM
// =======================================

// 🔧 Настройки amoCRM
$subdomain = 'shadoof';
$apiUrl = "https://{$subdomain}.amocrm.ru/api/v4"; // <== ВОТ ЭТО ОБЯЗАТЕЛЬНО НУЖНО
$access_token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImE3NTZmMjg3ZDIyMWQ5MTA3NjNjYjk3MDgxZmI3OTFmYTUxOGVhZTk2MTIwMDlmMWVlZjdmZDhhMWJkYzhiOTMwOTk4ZTYzMGRhZjMzNDJjIn0.eyJhdWQiOiJmZjZmMjlmMy02NjJkLTRiNzYtYTBlYy03YTc1OTRiYTE0YTYiLCJqdGkiOiJhNzU2ZjI4N2QyMjFkOTEwNzYzY2I5NzA4MWZiNzkxZmE1MThlYWU5NjEyMDA5ZjFlZWY3ZmQ4YTFiZGM4YjkzMDk5OGU2MzBkYWYzMzQyYyIsImlhdCI6MTc2MDY2NTIwOCwibmJmIjoxNzYwNjY1MjA4LCJleHAiOjE3Njg2OTQ0MDAsInN1YiI6IjEyOTQ1MjQyIiwiZ3JhbnRfdHlwZSI6IiIsImFjY291bnRfaWQiOjMxMTQ5Njc4LCJiYXNlX2RvbWFpbiI6ImFtb2NybS5ydSIsInZlcnNpb24iOjIsInNjb3BlcyI6WyJjcm0iXSwidXNlcl9mbGFncyI6MCwiaGFzaF91dWlkIjoiMWY0YmU2ZjMtY2U3MC00Y2FmLTg2NmUtNzkyY2VkMjQxMGNmIiwiYXBpX2RvbWFpbiI6ImFwaS1iLmFtb2NybS5ydSJ9.LkmdagndnsQyxJxheXtc-ICntn57M34BDxw4BVwMuJYOCbEpKAmIpJ1e0xfkgf8GtHT1CkLzSerq9-sJ0Ji-uiq28nRCToy6OjYjl6ZC2wTgcJ9H-gGKQbv_quYCQUgnhaapCaeGCvSKeBgEfaw5xAyuUyvwWKP58Y8S-J99L6FWBpLZ2RUSvyqBWqFWKaaG0fWSGNVW3TR2KIFXB_PLD8XdVlMRf2K_CniRbBEWL_hFLIlOO5Ye8G2Zq2zGu9K8tx2MUKMfOVUUCy3hmgEcT7G0mqgHbNKLSv_8K3Jsmi_ydNXv_Q2w1LzvYe9WAM3-QPyejvJsYHjVbtCFlx_HZA";


// Подключаем хук на все формы
add_action('wpcf7_mail_sent', 'send_any_cf7_to_amocrm');

function send_any_cf7_to_amocrm($contact_form) {
    global $apiUrl, $access_token;

    $submission = WPCF7_Submission::get_instance();
    if (!$submission) return;

    $data = $submission->get_posted_data();

    // Подставь свои имена полей из формы CF7
    $name  = sanitize_text_field($data['names'] ?? 'Без имени');
    $phone = sanitize_text_field($data['phones'] ?? 'Без телефона');

    // Заголовок страницы (например, товара)
    $product_name = function_exists('get_the_title') ? get_the_title() : 'Страница';

    // Формируем массив для complex endpoint
    $leadData = [
        'add' => [
            [
                'name' => "Заявка с сайта: $product_name",
                'tags' => ['Сайт'],
                '_embedded' => [
                    'contacts' => [
                        [
                            'first_name' => $name,
                            'custom_fields_values' => [
                                [
                                    'field_code' => 'PHONE',
                                    'values' => [['value' => $phone, 'enum_code' => 'WORK']]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ];

    // Отправляем в amoCRM
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

    if ($error) {
        error_log("❌ Ошибка cURL: $error");
    } else {
        error_log("✅ Отправлено в AmoCRM ($code): $response");
    }
}

