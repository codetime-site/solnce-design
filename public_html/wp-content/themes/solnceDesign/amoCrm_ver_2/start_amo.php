<?php
// start_amo.php

// === Настройки пайплайнов ===
$pipeline_svet_potolki = 6967578;
$status_svet_potolki   = 58548442;

$pipeline_divany = 9036022;
$status_divany   = 72787658;

function send_selected_cf7_to_amocrm($contact_form)
{
    global $pipeline_svet_potolki, $status_svet_potolki;
    global $pipeline_divany, $status_divany;

    $base = get_template_directory() . '/amoCrm_ver_2/';
    require_once $base . 'AmoConfig.php';
    require_once $base . 'ContactFormData.php';
    require_once $base . 'AmoClient.php';
    require_once $base . 'ContactService.php';
    require_once $base . 'LeadService.php';

    try {
        // --- Получаем данные формы ---
        $formData = ContactFormData::fromContactForm($contact_form);

        // --- Определяем категорию ---
        // допустим, в твоей форме CF7 есть скрытое поле [hidden product_id]
        // или ты передаёшь ID товара, чтобы можно было найти его категории
        $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

        // --- Проверяем категории ---
        $category_ids = $product_id ? wp_get_post_terms($product_id, 'product_cat', ['fields' => 'ids']) : [];

        // Массив ID категорий, которые относятся к "Свет_Потолки"
        $svet_potolki_categories = [25, 26]; // Потолки, Освещение

        // Если хоть одна категория продукта в списке свет/потолки — кидаем туда
        if (array_intersect($svet_potolki_categories, $category_ids)) {
            $pipeline_id = $pipeline_svet_potolki;
            $status_id   = $status_svet_potolki;
            $pipeline_name = 'Свет_Потолки';
        } else {
            $pipeline_id = $pipeline_divany;
            $status_id   = $status_divany;
            $pipeline_name = 'Диваны';
        }

        // --- AmoCRM логика ---
        $config = new AmoConfig($pipeline_id, $status_id);
        $client = new AmoClient($config->getSubdomain(), $config->getAccessToken());

        $contactService = new ContactService($client);
        $contactId = $contactService->createContact($formData);

        $leadService = new LeadService($client, $config->getPipelineId(), $config->getStatusId());
        $leadService->createLead($formData, $contactId);

        error_log("✅ Форма с продуктом #{$product_id} отправлена в воронку {$pipeline_name}");

    } catch (Exception $e) {
        error_log('❌ AMOCRM error: ' . $e->getMessage());
    }

    error_log('POST data: ' . print_r($_POST, true));

}

add_action('wpcf7_mail_sent', 'send_selected_cf7_to_amocrm');
