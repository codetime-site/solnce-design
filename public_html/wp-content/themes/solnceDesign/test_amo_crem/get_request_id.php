<?php
$subdomain = 'shadoof';

// варонка продаж
$pipeline = '10215146';

// статус 
$status_1 = "80872334";
$status_2 = "80872338";
$status_3 = "80872342";

// Загружаем токены из файла
$tokensFile = '/var/www/fastuser/data/www/solnce-design.ru/public_html/amocrm_tokens.json';
if (!file_exists($tokensFile)) {
    exit('❌ Файл токенов не найден. Сначала нужно авторизоваться.');
}

$tokens = json_decode(file_get_contents($tokensFile), true);
$access_token = $tokens['access_token'];




$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://{$subdomain}.amocrm.ru/api/v4/leads/pipelines/{$pipeline}/statuses",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer {$access_token}",
    ],
]);

$response = curl_exec($curl);
curl_close($curl);

echo $response;