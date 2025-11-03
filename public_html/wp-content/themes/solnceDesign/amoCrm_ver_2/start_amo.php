<?php
function send_selected_cf7_to_amocrm($contact_form)
{
    // === Настройки пайплайнов ===
    $pipeline_svet_potolki = 6967578;
    $status_svet_potolki = 58548442;

    $pipeline_divany = 9036022;
    $status_divany = 72787658;

    $base = get_template_directory() . '/amoCrm_ver_2/';
    require_once $base . 'AmoConfig.php';
    require_once $base . 'ContactFormData.php';
    require_once $base . 'AmoClient.php';
    require_once $base . 'ContactService.php';
    require_once $base . 'LeadService.php';

    try {
        // --- Получаем данные формы ---
        $formData = ContactFormData::fromContactForm($contact_form);
        $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

        if ($product_id <= 0) {
            error_log('❌ Ошибка: product_id не получен из формы.');
            return;
        }

        // Получаем стандартные категории WordPress
        $categories = get_the_category($product_id);

        if (is_wp_error($categories)) {
            error_log('❌ Ошибка получения категорий: ' . $categories->get_error_message());
            return;
        }

        error_log('Категории поста #' . $product_id . ': ' . print_r($categories, true));

        // Список “световых” ключевых слов (слаги)
        $svet_keywords = ['osveshhenie', 'lyustry', 'potolki'];
        $is_svet = false;

        if (!empty($categories)) {
            foreach ($categories as $category) {
                $slug = mb_strtolower($category->slug);
                if (in_array($slug, $svet_keywords, true)) {
                    $is_svet = true;
                    break;
                }
            }
        }

        if ($is_svet) {
            $pipeline_id = $pipeline_svet_potolki;
            $status_id = $status_svet_potolki;
            $pipeline_name = 'Свет_Потолки';
        } else {
            $pipeline_id = $pipeline_divany;
            $status_id = $status_divany;
            $pipeline_name = 'Диваны';
        }

        error_log("✅ Пост #{$product_id} отправлен в воронку {$pipeline_name}");

        // --- Проверяем категории товара ---
        $categories = $product_id ? wp_get_post_terms($product_id, 'product_cat', ['fields' => 'slugs']) : [];

        // Приводим к нижнему регистру для надёжности
        $categories_lower = array_map('mb_strtolower', $categories);

        // --- Определяем, в какую воронку отправлять ---

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

