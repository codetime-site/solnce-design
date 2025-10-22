<?php


$leadData = [
    [
        'name' => 'Новая сделка с сайта solnce-design',
        'price' => 1000,
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
    echo "❌ Ошибка при создании сделки\n";
}