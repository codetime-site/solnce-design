<?php 

// === Настройки ===
$subdomain = 'shadoof'; // твой поддомен AmoCRM
$pipeline_id = 6967578; // ID воронки
$status_id = 58548442;   // например, "Первичный контакт"
$amo_field_name = 1800461; // кастомный поля

// Загружаем токены из файла
$tokensFile = '/var/www/fastuser/data/www/solnce-design.ru/public_html/amocrm_tokens.json';
if (!file_exists($tokensFile)) {
    exit('❌ Файл токенов не найден. Сначала нужно авторизоваться.');
}

// json_decode() — это встроенная функция PHP, которая
//  используется для преобразования строки, закодированной в 
// формате JSON (JavaScript Object Notation), обратно 
// в нативные структуры данных PHP.
$tokens = json_decode(file_get_contents($tokensFile), true);
$access_token = $tokens['access_token'];