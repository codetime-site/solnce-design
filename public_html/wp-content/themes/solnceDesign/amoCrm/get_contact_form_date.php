<?php

// форма  
// $client_name = 'Халил';
// $client_phone = '+79998887766';
// $client_email = 'halil@example.com';
// $address = "https://hwllo";

// echo "<script> console.log('ушел');</script>";
// 🔹 ID формы, которую обрабатываем
$allowed_form_id = 337;
$form_id = $contact_form->id();
if ($form_id != $allowed_form_id) return;

// 🔹 Получаем данные формы
$submission = WPCF7_Submission::get_instance();
if (!$submission) return;
$data = $submission->get_posted_data();

$client_name = sanitize_text_field($data['names'] ?? 'Без имени');
$address = sanitize_text_field($data['city'] ?? 'Не указан город');
$client_phone = sanitize_text_field($data['phones'] ?? 'Без телефона');

// 🔹 Информация о сайте и странице
$product_name = get_bloginfo('name'); // имя сайта
$page_title = function_exists('get_the_title') ? get_the_title() : 'Страница без названия';