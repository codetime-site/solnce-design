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

    // === Маршрутизация форм по ID ===
    $form_to_pipeline = [
        782 => [
            'pipeline_id' => $pipeline_svet_potolki,
            'status_id'   => $status_svet_potolki,
            'label'       => 'Свет и потолки'
        ],
        337 => [
            'pipeline_id' => $pipeline_divany,
            'status_id'   => $status_divany,
            'label'       => 'Диваны'
        ]
    ];

    // === Подключаем модули ===
    $base = get_template_directory() . '/amoCrm_ver_2/';
    require_once $base . 'AmoConfig.php';
    require_once $base . 'ContactFormData.php';
    require_once $base . 'AmoClient.php';
    require_once $base . 'ContactService.php';
    require_once $base . 'LeadService.php';

    try {
        // Получаем ID текущей формы
        $form_id = method_exists($contact_form, 'id') ? $contact_form->id() : null;

        // Проверяем, есть ли этот ID в списке разрешённых
        if (!isset($form_to_pipeline[$form_id])) {
            throw new Exception("❌ Неизвестный ID формы: {$form_id}");
        }

        // Берем настройки для этой формы
        $pipeline_data = $form_to_pipeline[$form_id];

        // Создаём объект с данными формы
        $formData = ContactFormData::fromContactForm($contact_form, $form_id);

        // Загружаем конфигурацию AmoCRM
        $config = new AmoConfig($pipeline_data['pipeline_id'], $pipeline_data['status_id']);

        // Создаём клиента AmoCRM
        $client = new AmoClient($config->getSubdomain(), $config->getAccessToken());

        // Создаем контакт
        $contactService = new ContactService($client);
        $contactId = $contactService->createContact($formData);

        // Создаем сделку
        $leadService = new LeadService($client, $config->getPipelineId(), $config->getStatusId());
        $leadService->createLead($formData, $contactId);

        // Можно логировать для отладки
        error_log("✅ Успешно отправлена форма #{$form_id} ({$pipeline_data['label']}) в AmoCRM");

    } catch (Exception $e) {
        error_log('❌ AMOCRM error: ' . $e->getMessage());
    }
}

// Привязываем к хуку CF7
add_action('wpcf7_mail_sent', 'send_selected_cf7_to_amocrm');
