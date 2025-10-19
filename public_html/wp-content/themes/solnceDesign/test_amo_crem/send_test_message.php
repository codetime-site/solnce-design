<?php
// === Настройки аккаунта amoCRM ===
$subdomain = 'shadoof';
$apiUrl = "https://{$subdomain}.amocrm.ru/api/v4"; // <== ВОТ ЭТО ОБЯЗАТЕЛЬНО НУЖНО
$access_token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImE3NTZmMjg3ZDIyMWQ5MTA3NjNjYjk3MDgxZmI3OTFmYTUxOGVhZTk2MTIwMDlmMWVlZjdmZDhhMWJkYzhiOTMwOTk4ZTYzMGRhZjMzNDJjIn0.eyJhdWQiOiJmZjZmMjlmMy02NjJkLTRiNzYtYTBlYy03YTc1OTRiYTE0YTYiLCJqdGkiOiJhNzU2ZjI4N2QyMjFkOTEwNzYzY2I5NzA4MWZiNzkxZmE1MThlYWU5NjEyMDA5ZjFlZWY3ZmQ4YTFiZGM4YjkzMDk5OGU2MzBkYWYzMzQyYyIsImlhdCI6MTc2MDY2NTIwOCwibmJmIjoxNzYwNjY1MjA4LCJleHAiOjE3Njg2OTQ0MDAsInN1YiI6IjEyOTQ1MjQyIiwiZ3JhbnRfdHlwZSI6IiIsImFjY291bnRfaWQiOjMxMTQ5Njc4LCJiYXNlX2RvbWFpbiI6ImFtb2NybS5ydSIsInZlcnNpb24iOjIsInNjb3BlcyI6WyJjcm0iXSwidXNlcl9mbGFncyI6MCwiaGFzaF91dWlkIjoiMWY0YmU2ZjMtY2U3MC00Y2FmLTg2NmUtNzkyY2VkMjQxMGNmIiwiYXBpX2RvbWFpbiI6ImFwaS1iLmFtb2NybS5ydSJ9.LkmdagndnsQyxJxheXtc-ICntn57M34BDxw4BVwMuJYOCbEpKAmIpJ1e0xfkgf8GtHT1CkLzSerq9-sJ0Ji-uiq28nRCToy6OjYjl6ZC2wTgcJ9H-gGKQbv_quYCQUgnhaapCaeGCvSKeBgEfaw5xAyuUyvwWKP58Y8S-J99L6FWBpLZ2RUSvyqBWqFWKaaG0fWSGNVW3TR2KIFXB_PLD8XdVlMRf2K_CniRbBEWL_hFLIlOO5Ye8G2Zq2zGu9K8tx2MUKMfOVUUCy3hmgEcT7G0mqgHbNKLSv_8K3Jsmi_ydNXv_Q2w1LzvYe9WAM3-QPyejvJsYHjVbtCFlx_HZA";

// === Тестовые данные ===
$name = "Halil";
$email = "halil@gmail.com";
$phone = "123456789";
$message = "Тестовая заявка с сайта.";

// === Создаём контакт ===
$contactData = [
    [
        'name' => $name,
        'custom_fields_values' => [
            [
                'field_code' => 'PHONE',
                'values' => [['value' => $message, 'enum_code' => 'WORK']]
            ],
            [
                'field_code' => 'EMAIL',
                'values' => [['value' => $email, 'enum_code' => 'WORK']]
            ]
        ]
    ]
];

$ch = curl_init("$apiUrl/contacts");
curl_setopt($ch,  CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $access_token",
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($contactData));
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$contactResponse = json_decode($response, true);
$contactId = $contactResponse['_embedded']['contacts'][0]['id'] ?? null;

$title = "hello";
// === Создаём сделку ===
if ($contactId) {
    $leadData = [
        [
            'name' => "Заявка с сайта $title",
            'price' => 0,
            '_embedded' => [
                'contacts' => [['id' => $contactId]]
            ]
        ]
    ];

    $ch = curl_init("$apiUrl/leads");
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $access_token",
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($leadData));
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $leadResponse = json_decode($response, true);
    $leadId = $leadResponse['_embedded']['leads'][0]['id'] ?? null;

    // === Добавляем комментарий к сделке ===
    if ($leadId) {
        $noteData = [
            [
                'note_type' => 'common',
                'params' => ['text' => $message]
            ]
        ];

        $ch = curl_init("$apiUrl/leads/$leadId/notes");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $access_token",
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($noteData));
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200 || $httpCode == 201) {
            echo "✅ Сделка и контакт успешно созданы!\n";
        } else {
            echo "⚠️ Сделка создана, но не удалось добавить комментарий. Код: $httpCode\nОтвет: $response\n";
        }
    } else {
        echo "❌ Не удалось создать сделку. Ответ AmoCRM: $response\n";
    }
} else {
    echo "❌ Не удалось создать контакт. Ответ AmoCRM: $response\n";
}
?>
