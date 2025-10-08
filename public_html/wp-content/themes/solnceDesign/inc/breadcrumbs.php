<?php

function custom_breadcrumbs()
{
    // Настройки
    $separator = ' &raquo; '; // Разделитель
    $home_title = 'Главная';
    $breadcrumbs = array();

    // Начало контейнера
    $output = '<nav class="breadcrumbs" aria-label="Breadcrumb">';
    $output .= '<ul class="breadcrumbs-list">';

    // Главная страница
    $home_url = esc_url(home_url('/'));
    $breadcrumbs[] = '<li><a href="' . $home_url . '">' . esc_html($home_title) . '</a></li>';

    // Если это страница /category/ (ваш шаблон Categories Page)
    if (is_page('category')) {
        $breadcrumbs[] = '<li><span>Все категории</span></li>';
    }
    // Если это архив категории
    elseif (is_category()) {
        $category = get_queried_object();
        // Родительские категории (если есть)
        if ($category->parent) {
            $ancestors = array_reverse(get_ancestors($category->term_id, 'category', 'taxonomy'));
            foreach ($ancestors as $ancestor_id) {
                $ancestor = get_term($ancestor_id, 'category');
                $breadcrumbs[] = '<li><a href="' . esc_url(get_category_link($ancestor_id)) . '">' . esc_html($ancestor->name) . '</a></li>';
            }
        }
        // Текущая категория
        $breadcrumbs[] = '<li><span>' . esc_html(single_cat_title('', false)) . '</span></li>';
    }
    // Для других типов страниц (опционально, если нужно)
    elseif (is_single()) {
        $categories = get_the_category();
        if (!empty($categories)) {
            $category = $categories[0]; // Берем первую категорию
            $breadcrumbs[] = '<li><a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a></li>';
        }
        $breadcrumbs[] = '<li><span>' . esc_html(get_the_title()) . '</span></li>';
    } elseif (is_page() && !is_page('category')) {
        $ancestors = array_reverse(get_post_ancestors(get_the_ID()));
        foreach ($ancestors as $ancestor_id) {
            $breadcrumbs[] = '<li><a href="' . esc_url(get_permalink($ancestor_id)) . '">' . esc_html(get_the_title($ancestor_id)) . '</a></li>';
        }
        $breadcrumbs[] = '<li><span>' . esc_html(get_the_title()) . '</span></li>';
    }

    // Объединяем элементы с разделителем
    $output .= implode('<li class="separator">' . esc_html($separator) . '</li>', $breadcrumbs);
    $output .= '</ul>';
    $output .= '</nav>';

    return $output;
}