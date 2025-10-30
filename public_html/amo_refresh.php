<?php
$subdomain = 'shadoof';
$client_id = '1c452cac-b341-499a-87ac-ed9880e25e32';
$client_secret = 'dhG6ddkEADTEjoEaa7G1hnT7VFKhApWUi5oRVk6nbWdd6KrK6m5q34IwvLX7Zy5r';
$redirect_uri = 'https://solnce-design.ru/amo_codertime_site.php';

// Путь к лог-файлу
$logFile = __DIR__ . '/amo_refresh_log.txt';

// Логируем запуск
file_put_contents($logFile, date('Y-m-d H:i:s') . " — скрипт запущен\n", FILE_APPEND);

$endDate = '2026-10-24';
$currentDate = date('Y-m-d');

// Загружаем старые токены
$tokensPath = __DIR__ . '/amocrm_tokens.json';
if (!file_exists($tokensPath)) {
    file_put_contents($logFile, "❌ Не найден файл токенов\n", FILE_APPEND);
    exit;
}

$tokens = json_decode(file_get_contents($tokensPath), true);
if (!$tokens || !isset($tokens['refresh_token'])) {
    file_put_contents($logFile, "❌ Ошибка: отсутствует refresh_token\n", FILE_APPEND);
    exit;
}

if ($currentDate >= $endDate) {
    file_put_contents($logFile, "⚠️ Срок действия токена истёк ($endDate)\n", FILE_APPEND);
    exit;
}

$data = [
    "client_id" => $client_id,
    "client_secret" => $client_secret,
    "grant_type" => "refresh_token",
    "refresh_token" => $tokens['refresh_token'],
    "redirect_uri" => $redirect_uri
];

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://{$subdomain}.amocrm.ru/oauth2/access_token",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    file_put_contents($logFile, "❌ Ошибка cURL: {$err}\n", FILE_APPEND);
    exit;
}

$result = json_decode($response, true);

if (isset($result['access_token'])) {
    file_put_contents($tokensPath, json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    file_put_contents($logFile, "✅ Токен успешно обновлён\n", FILE_APPEND);
} else {
    file_put_contents($logFile, "❌ Ошибка при обновлении токена:\n" . print_r($result, true) . "\n", FILE_APPEND);
}
