<?php

// опеределенеи текуший страниецу 
$paged = get_query_var('paged') ? get_query_var(query_var: 'paged') : 1;

// Получаем все опубликованные посты, исключая категорию templates
$templates_category = get_term_by('slug', 'templates', 'category');
$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC'
);

if ($templates_category && !is_wp_error($templates_category)) {
    $args['category__not_in'] = array($templates_category->term_id);
}

$products_query = new WP_Query($args);
