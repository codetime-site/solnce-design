<?php

// ✅разделяй и властвуй  
// Запуск скрипта в среде WordPress (Рекомендуется, если нужны функции WP
// require_once('../../../../wp-load.php');


//     // 🔧 Настройки amoCRM для подключение 
// require_once get_template_directory() . "/amoCrm/setting_amo.php";
// require_once get_template_directory() . "/amoCrm/get_contact_form_date.php";
// require_once get_template_directory() . "/amoCrm/send_contact_form_date.php";
// require_once get_template_directory() . "/amoCrm/creat_leads.php";







// =======================================
// 💬 Интеграция Contact Form 7 → amoCRM
// =======================================

// Подключаем хук Contact Form 7
add_action('wpcf7_mail_sent', 'send_selected_cf7_to_amocrm');

function send_selected_cf7_to_amocrm($contact_form)
{
    require_once get_template_directory() . "/amoCrm/get_contact_form_date.php";
    require_once get_template_directory() . "/amoCrm/setting_amo.php";
    require_once get_template_directory() . "/amoCrm/send_contact_form_date.php";
    require_once get_template_directory() . "/amoCrm/creat_leads.php";
}





