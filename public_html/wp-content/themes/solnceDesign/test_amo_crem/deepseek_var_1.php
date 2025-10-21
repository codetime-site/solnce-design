<?php
// Функция для отправки данных в amoCRM
function send_cf7_to_amocrm($submission) {
    // === Настройки аккаунта amoCRM ===
    $subdomain = 'shadoof';
    $apiUrl = "https://{$subdomain}.amocrm.ru/api/v4";
    $access_token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImE3NTZmMjg3ZDIyMWQ5MTA3NjNjYjk3MDgxZmI3OTFmYTUxOGVhZTk2MTIwMDlmMWVlZjdmZDhhMWJkYzhiOTMwOTk4ZTYzMGRhZjMzNDJjIn0.eyJhdWQiOiJmZjZmMjlmMy02NjJkLTRiNzYtYTBlYy03YTc1OTRiYTE0YTYiLCJqdGkiOiJhNzU2ZjI4N2QyMjFkOTEwNzYzY2I5NzA4MWZiNzkxZmE1MThlYWU5NjEyMDA5ZjFlZWY3ZmQ4YTFiZGM4YjkzMDk5OGU2MzBkYWYzMzQyYyIsImlhdCI6MTc2MDY2NTIwOCwibmJmIjoxNzYwNjY1MjA4LCJleHAiOjE3Njg2OTQ0MDAsInN1YiI6IjEyOTQ1MjQyIiwiZ3JhbnRfdHlwZSI6IiIsImFjY291bnRfaWQiOjMxMTQ5Njc4LCJiYXNlX2RvbWFpbiI6ImFtb2NybS5ydSIsInZlcnNpb24iOjIsInNjb3BlcyI6WyJjcm0iXSwidXNlcl9mbGFncyI6MCwiaGFzaF91dWlkIjoiMWY0YmU2ZjMtY2U3MC00Y2FmLTg2NmUtNzkyY2VkMjQxMGNmIiwiYXBpX2RvbWFpbiI6ImFwaS1iLmFtb2NybS5ydSJ9.LkmdagndnsQyxJxheXtc-ICntn57M34BDxw4BVwMuJYOCbEpKAmIpJ1e0xfkgf8GtHT1CkLzSerq9-sJ0Ji-uiq28nRCToy6OjYjl6ZC2wTgcJ9H-gGKQbv_quYCQUgnhaapCaeGCvSKeBgEfaw5xAyuUyvwWKP58Y8S-J99L6FWBpLZ2RUSvyqBWqFWKaaG0fWSGNVW3TR2KIFXB_PLD8XdVlMRf2K_CniRbBEWL_hFLIlOO5Ye8G2Zq2zGu9K8tx2MUKMfOVUUCy3hmgEcT7G0mqgHbNKLSv_8K3Jsmi_ydNXv_Q2w1LzvYe9WAM3-QPyejvJsYHjVbtCFlx_HZA";

    // Получаем данные из формы
    $posted_data = $submission->get_posted_data();
    
    $name = isset($posted_data['names']) ? sanitize_text_field($posted_data['names']) : '';
    $city = isset($posted_data['city']) ? sanitize_text_field($posted_data['city']) : '';
    $phone = isset($posted_data['phones']) ? sanitize_text_field($posted_data['phones']) : '';
    
    // Проверяем обязательные поля
    if (empty($name) || empty($phone)) {
        return;
    }
    
    // Создаем название для лида
    $lead_name = "Заявка с сайта от " . $name;
    if (!empty($city)) {
        $lead_name .= " (" . $city . ")";
    }
    
    // Данные для создания лида
    $lead_data = [
        [
            "name" => $lead_name,
            "price" => 0
        ]
    ];
    
    // Создаем лид
    $lead_response = wp_remote_post("{$apiUrl}/leads", [
        'headers' => [
            'Authorization' => 'Bearer ' . $access_token,
            'Content-Type' => 'application/json'
        ],
        'body' => json_encode($lead_data),
        'timeout' => 30
    ]);
    
    if (is_wp_error($lead_response)) {
        error_log('CF7 to amoCRM Error: ' . $lead_response->get_error_message());
        return;
    }
    
    $lead_body = json_decode(wp_remote_retrieve_body($lead_response), true);
    
    if (!isset($lead_body['_embedded']['leads'][0]['id'])) {
        error_log('CF7 to amoCRM Error: Не удалось создать лид');
        return;
    }
    
    $lead_id = $lead_body['_embedded']['leads'][0]['id'];
    
    // Подготавливаем данные для контакта
    $contact_data = [
        [
            "first_name" => $name,
            "custom_fields_values" => []
        ]
    ];
    
    // Добавляем телефон
    if (!empty($phone)) {
        $contact_data[0]["custom_fields_values"][] = [
            "field_code" => "PHONE",
            "values" => [
                [
                    "value" => $phone,
                    "enum_code" => "WORK"
                ]
            ]
        ];
    }
    
    // Добавляем город в примечание или кастомное поле
    if (!empty($city)) {
        $contact_data[0]["custom_fields_values"][] = [
            "field_code" => "POSITION", // Или другое поле для города
            "values" => [
                [
                    "value" => $city
                ]
            ]
        ];
    }
    
    // Создаем контакт
    $contact_response = wp_remote_post("{$apiUrl}/contacts", [
        'headers' => [
            'Authorization' => 'Bearer ' . $access_token,
            'Content-Type' => 'application/json'
        ],
        'body' => json_encode($contact_data),
        'timeout' => 30
    ]);
    
    if (is_wp_error($contact_response)) {
        error_log('CF7 to amoCRM Error: ' . $contact_response->get_error_message());
        return;
    }
    
    $contact_body = json_decode(wp_remote_retrieve_body($contact_response), true);
    
    if (!isset($contact_body['_embedded']['contacts'][0]['id'])) {
        error_log('CF7 to amoCRM Error: Не удалось создать контакт');
        return;
    }
    
    $contact_id = $contact_body['_embedded']['contacts'][0]['id'];
    
    // Связываем лид с контактом
    $link_data = [
        [
            "to_entity_id" => $contact_id,
            "to_entity_type" => "contacts"
        ]
    ];
    
    $link_response = wp_remote_post("{$apiUrl}/leads/{$lead_id}/link", [
        'headers' => [
            'Authorization' => 'Bearer ' . $access_token,
            'Content-Type' => 'application/json'
        ],
        'body' => json_encode($link_data),
        'timeout' => 30
    ]);
    
    if (is_wp_error($link_response)) {
        error_log('CF7 to amoCRM Error: ' . $link_response->get_error_message());
    }
    
    // Логируем успешную отправку
    error_log('CF7 to amoCRM: Успешно созданы лид ' . $lead_id . ' и контакт ' . $contact_id);
}

// Хук для обработки отправки формы CF7
add_action('wpcf7_mail_sent', 'send_cf7_to_amocrm');
