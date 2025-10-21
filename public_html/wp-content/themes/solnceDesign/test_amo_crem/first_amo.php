<?php
// === Настройки ===
$subdomain = 'shadoof'; // твой поддомен AmoCRM
$pipeline_id = 10215146; // ID воронки
$status_id = 80872342;   // например, "Первичный контакт"

$amo_field_name = 1800461;
// $amo_field_ = 1800461;


// Загружаем токены из файла
$tokensFile = '/var/www/fastuser/data/www/solnce-design.ru/public_html/amocrm_tokens.json';
if (!file_exists($tokensFile)) {
    exit('❌ Файл токенов не найден. Сначала нужно авторизоваться.');
}

$tokens = json_decode(file_get_contents($tokensFile), true);
$access_token = $tokens['access_token'];


// === Данные клиента ===
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
            ]         
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
    // echo "✅ Сделка успешно создана!\n";
    // print_r(json_decode($response, true));
} else {
    // echo "❌ Ошибка при создании сдел";
}