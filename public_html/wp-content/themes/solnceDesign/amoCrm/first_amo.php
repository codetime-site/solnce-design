<?php

// разделяй и властвуй  

// Запуск скрипта в среде WordPress (Рекомендуется, если нужны функции WP
require_once('../../../../wp-load.php');

// настройка 
require_once get_template_directory() . "/test_amo_crem/setting_amo.php";


// === Данные клиента  от contact form 7 ===


$client_name = 'Халил';
$client_phone = '+79998887766';
$client_email = 'halil@example.com';
$address = "https://hwllo";

// === ШАГ 1. Создаём контакт ===
$contactData = [
    [
        'name' => $client_name,
        'custom_fields_values' => [
            [
                'field_code' => 'PHONE',
                'values' => [['value' => $client_phone, 'enum_code' => 'WORK']]
            ],
            [
                'field_code' => 'EMAIL',
                'values' => [['value' => $client_email, 'enum_code' => 'WORK']]
            ],
        ]
    ]
];

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => "https://{$subdomain}.amocrm.ru/api/v4/contacts",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($contactData, JSON_UNESCAPED_UNICODE),
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer {$access_token}",
        "Content-Type: application/json"
    ],
]);



$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200 && $httpCode !== 201) {
    echo "❌ Ошибка при создании контакта ({$httpCode})\n";
    print_r(json_decode($response, true));
    exit;
}

$contactResponse = json_decode($response, true);
$contact_id = $contactResponse['_embedded']['contacts'][0]['id'] ?? null;

if (!$contact_id) {
    echo "⚠️ Не удалось получить ID контакта.\n";
    print_r($contactResponse);
    exit;
}

// echo "✅ Контакт создан, ID: {$contact_id}\n";

// === ШАГ 2. Создаём сделку и привязываем контакт ===
$leadData = [
    [
        'name' => 'Новая сделка с сайта',
        'price' => 15000,
        'status_id' => $status_id,
        'pipeline_id' => $pipeline_id,
        'custom_fields_values' => [
            [
                'field_id' => 1800461, // ID поля "URL"
                'values' => [
                    ['value' => $client_name]
                ]
            ],
            [
                'field_id' => 1800463, // ID поля "phone"
                'values' => [
                    ['value' => $client_phone]
                ]
            ],
            [
                'field_id' => 1800483, // ID поля "link"
                'values' => [
                    ['value' => $address] 
                ]
            ]
        ],
        '_embedded' => [
            'contacts' => [
                ['id' => $contact_id]
            ]
        ]
    ]
];

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => "https://{$subdomain}.amocrm.ru/api/v4/leads",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($leadData, JSON_UNESCAPED_UNICODE),
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer {$access_token}",
        "Content-Type: application/json"
    ],
]);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode === 200 || $httpCode === 201) {
    echo "✅ Сделка успешно создана!\n";
    // print_r(json_decode($response, true));
} else {
    echo "❌ Ошибка при создании сдел";
}