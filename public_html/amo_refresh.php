<?php
$subdomain = 'shadoof';
$client_id = '1c452cac-b341-499a-87ac-ed9880e25e32';
$client_secret = 'dhG6ddkEADTEjoEaa7G1hnT7VFKhApWUi5oRVk6nbWdd6KrK6m5q34IwvLX7Zy5r';
$redirect_uri = 'https://solnce-design.ru/amo_codertime_site.php';


$endDate = '2026-10-24';

$currentDate = date('Y-m-d');

// Загружаем старые токены
$tokens = json_decode(file_get_contents('amocrm_tokens.json'), true);

$data = [
    "client_id" => $client_id,
    "client_secret" => $client_secret,
    "grant_type" => "refresh_token",
    "refresh_token" => $tokens['refresh_token'],
    "redirect_uri" => $redirect_uri
];

if ($currentDate >= $endDate) {
      echo "❌ Ошибка cURL: Не удалось инициализировать cURL.";
    exit();
}

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://{$subdomain}.amocrm.ru/oauth2/access_token");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($curl);
curl_close($curl);

$result = json_decode($response, true);

if (isset($result['access_token'])) {
    file_put_contents('amocrm_tokens.json', json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo "✅ Токен успешно обновлён!";
} else {
    echo "❌ Ошибка при обновлении токена:<br><pre>";
    print_r($result);
    echo "</pre>";
}

?>