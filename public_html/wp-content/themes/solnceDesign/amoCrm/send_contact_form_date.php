<?php 

// создание контакта  
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

echo "✅ Контакт создан, ID: {$contact_id}\n";
