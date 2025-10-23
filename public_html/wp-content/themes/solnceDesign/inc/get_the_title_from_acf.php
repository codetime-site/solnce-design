<?php 

function get_acf_field_for_cf7($field_name) {
    // Проверяем, что ACF установлен и что мы находимся на странице/посте
    if ( function_exists('get_sub_field') && (is_singular() || is_archive() || is_home() || is_single()) ) {
        // Получаем значение поля ACF для текущего поста/страницы
        $acf_value = get_sub_field( $field_name);
        
        // Возвращаем значение, убедившись, что оно безопасно для HTML
        return esc_html($acf_value);
    }
    return '';
}

// 1. Создаем шорткод [acf_page_title] для поля с именем 'page_custom_title'
add_shortcode( 'acf_page_title', function() {
    // Замените 'page_custom_title' на реальное имя вашего поля ACF
    return get_acf_field_for_cf7('title'); 
});