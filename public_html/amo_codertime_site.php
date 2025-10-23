<?php

// Настройки интеграции:
$subdomain = 'shadoof'; // ← твой поддомен AmoCRM (см. в ссылке — shadoof.amocrm.ru)
$client_id = '1c452cac-b341-499a-87ac-ed9880e25e32';
$client_secret = 'dhG6ddkEADTEjoEaa7G1hnT7VFKhApWUi5oRVk6nbWdd6KrK6m5q34IwvLX7Zy5r';
$redirect_uri = 'https://solnce-design.ru/amo_codertime_site.php';

// Код, который ты получил в URL
$code = 'def5020006fa8cd861e466d87348c7d52c7a54cfffc29c963ba8569f9128dc8729008615bd698444697a8c894201b7cc97df5c643e559fe8571a8625f10d4b91205b1f991d55ed90f7c139abc070ca427412536170d83c2642cd419b75c9588c089ea99b6a2fac40e3668100f480f267cb7e3574d93971999de97208ed5b906bd5749df88ad9b1779d40198c5cf40dcaa6383225be45f420f71329889918f548a1db908a1e5e59ba1b2708fdd8ddaed3702369a16bba3d77e770b678b31b9c8892ef784888c6cdb738e515c7d62c9430363b813bf43395d15cb22f55014dce226149877ccca8d2e79c458d0431acd4f6bad510e1ad2df32a6cdfd1c27582e08d07751aed1515ece55557d022d5abd3827259b390e278b35b330e92d8e235ff802f1985a605031903feb55f954e33f8e92517d79eea301e2fe584889cff16821883cb3035ad072f6fa2c39b433e8f9ebe93d5e2cd145db1bab00afc81765c581b0ac0dd4a6de37820e817bf71c1b23f73755de391726ee2502644081afc04e2783b3be5fbe5fb746d49ace44e2eae6e86d3fd77d136dbb13577963f324ec35f92b8a7b388a876ad3eef5387e520740be106fae94da348a5aa9741a45ac617f0e64959ac7def';

// Формируем запрос для обмена code → access_token
$data = [
    "client_id" => $client_id,
    "client_secret" => $client_secret,
    "grant_type" => "authorization_code",
    "code" => $code,
    "redirect_uri" => $redirect_uri
];

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
    echo "✅ Успешно! Токен сохранён в amocrm_tokens.json";
} else {
    echo "❌ Ошибка авторизации:<br><pre>";
    print_r($result);
    echo "</pre>";
}
