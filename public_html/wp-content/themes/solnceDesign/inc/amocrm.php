<?php


/* ========== НАСТРОЙКИ ========== */
if (!defined('AMO_CLIENT_ID'))
    define('AMO_CLIENT_ID', '1ff29221-5b15-4c2b-96f7-035476c337fe');
if (!defined('AMO_CLIENT_SECRET'))
    define('AMO_CLIENT_SECRET', 'fvInX3QtUKjrNFwyCW2sjqeSeFmGUnTHR0KLV5VipELQCR3KCUwcVoQfJwYned8t');
if (!defined('AMO_SUBDOMAIN'))
    define('AMO_SUBDOMAIN', 'shadoof'); // без .amocrm.ru
if (!defined('AMO_REDIRECT_URI'))
    define('AMO_REDIRECT_URI', admin_url('admin-post.php?action=amocrm_auth'));
if (!defined('AMO_RESPONSIBLE_ID'))
    define('AMO_RESPONSIBLE_ID', 12945242); // ID менеджера
if (!defined('AMO_PIPELINE_ID'))
    define('AMO_PIPELINE_ID', 123456); // ID вашей воронки
if (!defined('AMO_STATUS_ID'))
    define('AMO_STATUS_ID', 142); // ID этапа
/* ===================================================== */

/* === 1) Страница авторизации amoCRM === */
add_action('admin_menu', function () {
    add_menu_page('amoCRM Auth', 'amoCRM', 'manage_options', 'amocrm-auth', 'amocrm_auth_page_html');
});
function amocrm_auth_page_html()
{
    if (!current_user_can('manage_options'))
        return;
    $auth_url = 'https://www.amocrm.ru/oauth?client_id=' . AMO_CLIENT_ID . '&redirect_uri=' . urlencode(AMO_REDIRECT_URI) . '&state=' . wp_create_nonce('amocrm_state');
    echo '<div class="wrap"><h2>amoCRM — подключение</h2>';
    echo '<p>Нажмите кнопку, чтобы открыть окно авторизации в amoCRM:</p>';
    echo '<p><a class="button button-primary" href="' . esc_url($auth_url) . '" target="_blank">Подключить amoCRM</a></p>';
    $tokens = get_option('amocrm_tokens', false);
    echo '<h3>Статус токенов</h3><pre>' . esc_html(print_r($tokens, true)) . '</pre>';
    echo '</div>';
}

/* === 2) Обработчик Redirect URI === */
add_action('admin_post_amocrm_auth', 'amocrm_handle_auth');
function amocrm_handle_auth()
{
    if (!current_user_can('manage_options'))
        wp_die('Access denied');
    if (isset($_GET['error']))
        wp_die('Authorization error: ' . esc_html($_GET['error']));
    if (!isset($_GET['code']))
        wp_die('No authorization code received.');

    $code = sanitize_text_field($_GET['code']);
    $url = "https://" . AMO_SUBDOMAIN . ".amocrm.ru/oauth2/access_token";
    $body = [
        'client_id' => AMO_CLIENT_ID,
        'client_secret' => AMO_CLIENT_SECRET,
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => AMO_REDIRECT_URI
    ];

    $resp = wp_remote_post($url, [
        'headers' => ['Content-Type' => 'application/json'],
        'body' => wp_json_encode($body),
        'timeout' => 20,
    ]);

    if (is_wp_error($resp))
        wp_die('Request error: ' . $resp->get_error_message());

    $data = json_decode(wp_remote_retrieve_body($resp), true);
    if (isset($data['access_token'])) {
        $data['saved_at'] = time();
        update_option('amocrm_tokens', $data);
        wp_redirect(admin_url('admin.php?page=amocrm-auth&amocrm_connected=1'));
        exit;
    } else {
        wp_die('Token error: ' . esc_html(print_r($data, true)));
    }
}

/* === 3) Получение / обновление access_token === */
function amocrm_get_access_token()
{
    $tokens = get_option('amocrm_tokens', false);
    if (!$tokens)
        return false;

    $expires = intval($tokens['expires_in'] ?? 0);
    $saved = intval($tokens['saved_at'] ?? 0);

    if ($expires && $saved && (time() > ($saved + $expires - 60))) {
        $url = "https://" . AMO_SUBDOMAIN . ".amocrm.ru/oauth2/access_token";
        $body = [
            'client_id' => AMO_CLIENT_ID,
            'client_secret' => AMO_CLIENT_SECRET,
            'grant_type' => 'refresh_token',
            'refresh_token' => $tokens['refresh_token'],
            'redirect_uri' => AMO_REDIRECT_URI
        ];
        $resp = wp_remote_post($url, [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => wp_json_encode($body),
            'timeout' => 20,
        ]);
        if (is_wp_error($resp))
            return false;
        $new = json_decode(wp_remote_retrieve_body($resp), true);
        if (isset($new['access_token'])) {
            $new['saved_at'] = time();
            update_option('amocrm_tokens', $new);
            return $new['access_token'];
        }
        return false;
    }

    return $tokens['access_token'] ?? false;
}

/* === 4) Создание сделки + контакт + уведомление === */
function amocrm_create_lead_with_contact($name, $phone, $product_url = '')
{
    $token = amocrm_get_access_token();
    if (!$token)
        return new WP_Error('no_token', 'No access token');

    $url = "https://" . AMO_SUBDOMAIN . ".amocrm.ru/api/v4/leads/complex";

    $lead = [
        "name" => "Заявка с сайта: " . ($product_url ?: $name),
        "pipeline_id" => AMO_PIPELINE_ID,
        "status_id" => AMO_STATUS_ID,
        "responsible_user_id" => AMO_RESPONSIBLE_ID,
        "_embedded" => [
            "contacts" => [
                [
                    "name" => $name,
                    "custom_fields_values" => [
                        [
                            "field_code" => "PHONE",
                            "values" => [["value" => $phone, "enum_code" => "MOB"]]
                        ]
                    ]
                ]
            ]
        ],
        "custom_fields_values" => [
            ["field_name" => "Источник", "values" => [["value" => "Сайт"]]],
            ["field_name" => "Товар / ссылка", "values" => [["value" => $product_url]]]
        ]
    ];

    $resp = wp_remote_post($url, [
        'headers' => ['Content-Type' => 'application/json', 'Authorization' => 'Bearer ' . $token],
        'body' => wp_json_encode([$lead]),
        'timeout' => 20,
    ]);

    if (is_wp_error($resp))
        return $resp;
    $result = json_decode(wp_remote_retrieve_body($resp), true);

    // Добавляем заметку с уведомлением
    if (!empty($result['_embedded']['leads'][0]['id'])) {
        $lead_id = $result['_embedded']['leads'][0]['id'];
        $note_url = "https://" . AMO_SUBDOMAIN . ".amocrm.ru/api/v4/notes";
        $note = [
            "element_id" => $lead_id,
            "element_type" => 2, // 2 = Lead
            "note_type" => "task", // уведомление
            "params" => [
                "text" => "Сообщение с формы: Имя: $name, Телефон: $phone, Товар: $product_url",
                "task_type" => 2,
                "responsible_user_id" => AMO_RESPONSIBLE_ID,
                "complete_till" => time() + 3600
            ]
        ];
        wp_remote_post($note_url, [
            'headers' => ['Content-Type' => 'application/json', 'Authorization' => 'Bearer ' . $token],
            'body' => wp_json_encode([$note]),
            'timeout' => 20
        ]);
    }

    return $result;
}

/* === 5) Привязка к Contact Form 7 === */
add_action('wpcf7_mail_sent', function ($contact_form) {
    $submission = WPCF7_Submission::get_instance();
    if (!$submission)
        return;
    $data = $submission->get_posted_data();

    $name = sanitize_text_field($data['your-name'] ?? $data['names'] ?? $data['name'] ?? '');
    $phone = sanitize_text_field($data['your-phone'] ?? $data['phones'] ?? $data['phone'] ?? '');
    $product_url = sanitize_text_field($data['product_url'] ?? ($_SERVER['HTTP_REFERER'] ?? ''));

    if ($phone) {
        $res = amocrm_create_lead_with_contact($name ?: 'Без имени', $phone, $product_url);
        if (is_wp_error($res))
            error_log('amoCRM error: ' . $res->get_error_message());
        else
            error_log('amoCRM create lead response: ' . print_r($res, true));
    }
});
