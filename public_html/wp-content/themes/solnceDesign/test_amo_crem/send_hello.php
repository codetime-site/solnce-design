<?php
// ===============================
// 🔗 Простейшая интеграция CF7 → amoCRM
// ===============================


add_action('wpcf7_mail_sent', 'send_simple_message_to_amocrm');

function send_simple_message_to_amocrm()
{
    // Настройки amoCRM
    $subdomain = 'shadoof';
    $apiUrl = "https://{$subdomain}.amocrm.ru/api/v4"; // <== ВОТ ЭТО ОБЯЗАТЕЛЬНО НУЖНО
    $access_token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImE3NTZmMjg3ZDIyMWQ5MTA3NjNjYjk3MDgxZmI3OTFmYTUxOGVhZTk2MTIwMDlmMWVlZjdmZDhhMWJkYzhiOTMwOTk4ZTYzMGRhZjMzNDJjIn0.eyJhdWQiOiJmZjZmMjlmMy02NjJkLTRiNzYtYTBlYy03YTc1OTRiYTE0YTYiLCJqdGkiOiJhNzU2ZjI4N2QyMjFkOTEwNzYzY2I5NzA4MWZiNzkxZmE1MThlYWU5NjEyMDA5ZjFlZWY3ZmQ4YTFiZGM4YjkzMDk5OGU2MzBkYWYzMzQyYyIsImlhdCI6MTc2MDY2NTIwOCwibmJmIjoxNzYwNjY1MjA4LCJleHAiOjE3Njg2OTQ0MDAsInN1YiI6IjEyOTQ1MjQyIiwiZ3JhbnRfdHlwZSI6IiIsImFjY291bnRfaWQiOjMxMTQ5Njc4LCJiYXNlX2RvbWFpbiI6ImFtb2NybS5ydSIsInZlcnNpb24iOjIsInNjb3BlcyI6WyJjcm0iXSwidXNlcl9mbGFncyI6MCwiaGFzaF91dWlkIjoiMWY0YmU2ZjMtY2U3MC00Y2FmLTg2NmUtNzkyY2VkMjQxMGNmIiwiYXBpX2RvbWFpbiI6ImFwaS1iLmFtb2NybS5ydSJ9.LkmdagndnsQyxJxheXtc-ICntn57M34BDxw4BVwMuJYOCbEpKAmIpJ1e0xfkgf8GtHT1CkLzSerq9-sJ0Ji-uiq28nRCToy6OjYjl6ZC2wTgcJ9H-gGKQbv_quYCQUgnhaapCaeGCvSKeBgEfaw5xAyuUyvwWKP58Y8S-J99L6FWBpLZ2RUSvyqBWqFWKaaG0fWSGNVW3TR2KIFXB_PLD8XdVlMRf2K_CniRbBEWL_hFLIlOO5Ye8G2Zq2zGu9K8tx2MUKMfOVUUCy3hmgEcT7G0mqgHbNKLSv_8K3Jsmi_ydNXv_Q2w1LzvYe9WAM3-QPyejvJsYHjVbtCFlx_HZA";

    $leadData = [
        [
            'name' => 'new 👋',
            'do'=> 'hello world',
        ]
    ];

    $ch = curl_init("$apiUrl/leads");
    curl_setopt_array($ch, [
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer $access_token",
            "Content-Type: application/json"
        ],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($leadData)
    ]);

    $response = curl_exec($ch);
    $error = curl_error($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    error_log("Ответ AmoCRM ($code): $response");
}
