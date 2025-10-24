<?php

add_filter('wpcf7_form_tag', function ($tag) {
    // Проверяем, что у тега есть имя (совместимость с разными версиями CF7)
    if (empty($tag['name'])) {
        return $tag;
    }

    // Получаем ID текущего поста (страницы/товара)
    $post_id = get_the_ID();

    // Обработаем нужные нам поля по имени
    if ($tag['name'] === 'acf_title') {
        // Используем get_sub_field, т.к. у тебя так работало
        $acf_value = function_exists('get_sub_field') ? get_sub_field('title') : null;
        $tag['values'] = [$acf_value ?: 'Заголовок по умолчанию'];
    }
    if ($tag['name'] === 'acf_sub_title') {
        $acf_value = function_exists('get_sub_field') ? get_sub_field('rec_sub_title') : null;

        $tag['values'] = [$acf_value ?: 'Заголовок по умолчанию'];
    }
    if ($tag['name'] === 'acf_link') {
        $permalink = $post_id ? get_permalink($post_id) : home_url('/');
        $tag['values'] = [esc_url_raw($permalink)];
    }

    if ($tag['name'] === 'acf_image') {
        $post_id = get_the_ID();

        // Пытаемся получить изображение из ACF
        // Сначала из back_img, потом из img
        // $image = get_sub_field('back_img', $post_id) ?: get_sub_field('img', $post_id);
        $image = get_sub_field('back_img');
        // $image = get_sub_field('back_img') ?: get_sub_field('img');

        // Преобразуем в URL, если это массив или ID
        if (is_array($image) && isset($image['url'])) {
            $image = $image['url'];
            var_dump($image);
        } elseif (is_numeric($image)) {
            $image = wp_get_attachment_url($image);
        }

        // Подставляем значение
        // $tag['values'] = [esc_url_raw($image ?: '/')];
        $tag['values'] = [$image ?: '/'];
    }

    return $tag;
});
