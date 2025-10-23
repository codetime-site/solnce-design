<?php
// start_amo.php


// $pipeline_svet_potolki = 6967578;
// $status_svet_potolki = 58548442;
// $pipeline_divany = 9036022;
// $status_divany = 72787658;

function send_selected_cf7_to_amocrm($contact_form)
{
    // global $pipeline_svet_potolki;
    // global $status_svet_potolki;
    // global $pipeline_divany;
    // global $status_divany;

    
    $pipeline_svet_potolki = 6967578;
    $status_svet_potolki = 58548442;
    $pipeline_divany = 9036022;
    $status_divany = 72787658;


    // Подключаем модули
    $base = get_template_directory() . '/amoCrm_ver_2/';

    require_once $base . 'AmoConfig.php';
    require_once $base . 'ContactFormData.php';
    require_once $base . 'AmoClient.php';
    require_once $base . 'ContactService.php';
    require_once $base . 'LeadService.php';

    try {
        // Получаем и валидируем данные формы   
        $formData = ContactFormData::fromContactForm($contact_form);

        // Загружаем конфиг (поддомен, токен, pipeline/status)
        $config = new AmoConfig($pipeline_divany, $status_divany);

        // Клиент для запросов к amoCRM
        $client = new AmoClient($config->getSubdomain(), $config->getAccessToken());

        // Создаем/обновляем контакт
        $contactService = new ContactService($client);
        $contactId = $contactService->createContact($formData);

        // Создаем сделку и связываем контакт
        $leadService = new LeadService($client, $config->getPipelineId(), $config->getStatusId());
        $leadService->createLead($formData, $contactId);

    } catch (Exception $e) {
        // Логируем ошибку, не ломаем сайт
        error_log('AMOCRM error: ' . $e->getMessage());
    }
}

// Пример: подключить к хуку Contact Form 7
// add_action('wpcf7_mail_sent', 'send_selected_cf7_to_amocrm');

