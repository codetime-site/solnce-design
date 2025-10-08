<?php
/**
 * Дополнительные функции для работы с категориями
 * Подключается в functions.php
 */

// Функция для получения иерархии категорий
function get_category_hierarchy($parent_id = 0, $level = 0) {
    $categories = get_categories(array(
        'parent' => $parent_id,
        'hide_empty' => false,
        'orderby' => 'name',
        'order' => 'ASC'
    ));
    
    $hierarchy = array();
    
    foreach ($categories as $category) {
        if ($category->slug !== 'templates') {
            $category_data = array(
                'id' => $category->term_id,
                'name' => $category->name,
                'slug' => $category->slug,
                'description' => $category->description,
                'count' => $category->count,
                'link' => get_category_link($category->term_id),
                'level' => $level,
                'image' => get_field('img', 'category_' . $category->term_id),
                'children' => array()
            );
            
            // Рекурсивно получаем дочерние категории
            $children = get_category_hierarchy($category->term_id, $level + 1);
            if (!empty($children)) {
                $category_data['children'] = $children;
            }
            
            $hierarchy[] = $category_data;
        }
    }
    
    return $hierarchy;
}

// Функция для отображения хлебных крошек категорий
function custom_category_breadcrumbs($category_id = null) {
    if (!$category_id) {
        if (is_category()) {
            $category = get_queried_object();
            $category_id = $category->term_id;
        } else {
            return '';
        }
    }
    
    $category = get_category($category_id);
    if (!$category) {
        return '';
    }
    
    $breadcrumbs = array();
    
    // Получаем всех предков
    $ancestors = get_ancestors($category_id, 'category');
    $ancestors = array_reverse($ancestors);
    
    foreach ($ancestors as $ancestor_id) {
        $ancestor = get_category($ancestor_id);
        if ($ancestor) {
            $breadcrumbs[] = sprintf(
                '<a href="%s">%s</a>',
                esc_url(get_category_link($ancestor_id)),
                esc_html($ancestor->name)
            );
        }
    }
    
    // Добавляем текущую категорию
    $breadcrumbs[] = sprintf(
        '<span class="current">%s</span>',
        esc_html($category->name)
    );
    
    $output = '<nav class="category-breadcrumbs">';
    $output .= '<ul class="breadcrumb-list">';
    
    // Главная страница
    $output .= '<li><a href="' . esc_url(home_url('/')) . '">Главная</a></li>';
    
    // Категории
    foreach ($breadcrumbs as $breadcrumb) {
        $output .= '<li class="separator">→</li>';
        $output .= '<li>' . $breadcrumb . '</li>';
    }
    
    $output .= '</ul>';
    $output .= '</nav>';
    
    return $output;
}

// Функция для получения статистики категорий
function get_category_stats($category_id = null) {
    if (!$category_id) {
        if (is_category()) {
            $category = get_queried_object();
            $category_id = $category->term_id;
        } else {
            return array();
        }
    }
    
    $category = get_category($category_id);
    if (!$category) {
        return array();
    }
    
    // Получаем все дочерние категории
    $children = get_categories(array(
        'parent' => $category_id,
        'hide_empty' => false
    ));
    
    // Подсчитываем общее количество постов во всех дочерних категориях
    $total_posts = $category->count;
    foreach ($children as $child) {
        $total_posts += $child->count;
    }
    
    return array(
        'category_name' => $category->name,
        'direct_posts' => $category->count,
        'total_posts' => $total_posts,
        'children_count' => count($children),
        'children' => $children
    );
}

// Функция для поиска категорий
function search_categories($search_term, $parent_id = null) {
    $args = array(
        'search' => $search_term,
        'hide_empty' => false,
        'orderby' => 'name',
        'order' => 'ASC'
    );
    
    if ($parent_id !== null) {
        $args['parent'] = $parent_id;
    }
    
    $categories = get_categories($args);
    
    $results = array();
    
    foreach ($categories as $category) {
        if ($category->slug !== 'templates') {
            $results[] = array(
                'id' => $category->term_id,
                'name' => $category->name,
                'slug' => $category->slug,
                'description' => $category->description,
                'count' => $category->count,
                'link' => get_category_link($category->term_id),
                'parent' => $category->parent,
                'parent_name' => $category->parent ? get_category($category->parent)->name : '',
                'image' => get_field('img', 'category_' . $category->term_id)
            );
        }
    }
    
    return $results;
}

// Функция для получения популярных категорий
function get_popular_categories($limit = 10, $parent_id = 0) {
    $args = array(
        'orderby' => 'count',
        'order' => 'DESC',
        'hide_empty' => true,
        'number' => $limit
    );
    
    if ($parent_id !== null) {
        $args['parent'] = $parent_id;
    }
    
    $categories = get_categories($args);
    
    $popular = array();
    
    foreach ($categories as $category) {
        if ($category->slug !== 'templates') {
            $popular[] = array(
                'id' => $category->term_id,
                'name' => $category->name,
                'slug' => $category->slug,
                'count' => $category->count,
                'link' => get_category_link($category->term_id),
                'image' => get_field('img', 'category_' . $category->term_id)
            );
        }
    }
    
    return $popular;
}

// Функция для получения случайных категорий
function get_random_categories($limit = 5, $parent_id = 0) {
    $args = array(
        'orderby' => 'rand',
        'hide_empty' => false,
        'number' => $limit
    );
    
    if ($parent_id !== null) {
        $args['parent'] = $parent_id;
    }
    
    $categories = get_categories($args);
    
    $random = array();
    
    foreach ($categories as $category) {
        if ($category->slug !== 'templates') {
            $random[] = array(
                'id' => $category->term_id,
                'name' => $category->name,
                'slug' => $category->slug,
                'count' => $category->count,
                'link' => get_category_link($category->term_id),
                'image' => get_field('img', 'category_' . $category->term_id)
            );
        }
    }
    
    return $random;
}

// Функция для получения категорий с изображениями
function get_categories_with_images($parent_id = 0, $hide_empty = false) {
    $args = array(
        'parent' => $parent_id,
        'hide_empty' => $hide_empty,
        'orderby' => 'name',
        'order' => 'ASC'
    );
    
    $categories = get_categories($args);
    
    $categories_with_images = array();
    
    foreach ($categories as $category) {
        if ($category->slug !== 'templates') {
            $image = get_field('img', 'category_' . $category->term_id);
            
            if ($image) {
                $image_url = is_array($image) ? $image['url'] : $image;
                $image_alt = is_array($image) ? ($image['alt'] ?? $category->name) : $category->name;
            } else {
                $image_url = get_template_directory_uri() . '/assets/img/category-placeholder.jpg';
                $image_alt = $category->name;
            }
            
            $categories_with_images[] = array(
                'id' => $category->term_id,
                'name' => $category->name,
                'slug' => $category->slug,
                'description' => $category->description,
                'count' => $category->count,
                'link' => get_category_link($category->term_id),
                'parent' => $category->parent,
                'image_url' => $image_url,
                'image_alt' => $image_alt
            );
        }
    }
    
    return $categories_with_images;
}

// Функция для получения дерева категорий в виде HTML
function render_category_tree($parent_id = 0, $level = 0, $max_level = 3) {
    if ($level >= $max_level) {
        return '';
    }
    
    $categories = get_categories(array(
        'parent' => $parent_id,
        'hide_empty' => false,
        'orderby' => 'name',
        'order' => 'ASC'
    ));
    
    if (empty($categories)) {
        return '';
    }
    
    $output = '<ul class="category-tree level-' . $level . '">';
    
    foreach ($categories as $category) {
        if ($category->slug !== 'templates') {
            $output .= '<li class="category-tree-item">';
            $output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="category-tree-link">';
            $output .= esc_html($category->name);
            if ($category->count > 0) {
                $output .= ' <span class="category-count">(' . $category->count . ')</span>';
            }
            $output .= '</a>';
            
            // Рекурсивно получаем дочерние категории
            $children_html = render_category_tree($category->term_id, $level + 1, $max_level);
            if ($children_html) {
                $output .= $children_html;
            }
            
            $output .= '</li>';
        }
    }
    
    $output .= '</ul>';
    
    return $output;
}

// Шорткод для отображения дерева категорий
function category_tree_shortcode($atts) {
    $atts = shortcode_atts(array(
        'parent' => 0,
        'level' => 3,
        'class' => 'category-tree-shortcode'
    ), $atts);
    
    $tree = render_category_tree($atts['parent'], 0, $atts['level']);
    
    return '<div class="' . esc_attr($atts['class']) . '">' . $tree . '</div>';
}
add_shortcode('category_tree', 'category_tree_shortcode');

// Шорткод для отображения популярных категорий
function popular_categories_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => 5,
        'parent' => 0,
        'class' => 'popular-categories'
    ), $atts);
    
    $categories = get_popular_categories($atts['limit'], $atts['parent']);
    
    if (empty($categories)) {
        return '<p>Популярные категории не найдены.</p>';
    }
    
    $output = '<div class="' . esc_attr($atts['class']) . '">';
    $output .= '<ul class="popular-categories-list">';
    
    foreach ($categories as $category) {
        $output .= '<li class="popular-category-item">';
        $output .= '<a href="' . esc_url($category['link']) . '">';
        $output .= esc_html($category['name']);
        $output .= ' <span class="count">(' . $category['count'] . ')</span>';
        $output .= '</a>';
        $output .= '</li>';
    }
    
    $output .= '</ul>';
    $output .= '</div>';
    
    return $output;
}
add_shortcode('popular_categories', 'popular_categories_shortcode');

// AJAX обработчики
add_action('wp_ajax_search_categories_ajax', 'search_categories_ajax_handler');
add_action('wp_ajax_nopriv_search_categories_ajax', 'search_categories_ajax_handler');

function search_categories_ajax_handler() {
    $search_term = sanitize_text_field($_POST['search_term']);
    $parent_id = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : null;
    
    if (empty($search_term)) {
        wp_send_json_error('Пустой поисковый запрос');
        return;
    }
    
    $results = search_categories($search_term, $parent_id);
    
    wp_send_json_success($results);
}

// Добавляем стили для дерева категорий
add_action('wp_head', 'category_tree_styles');

function category_tree_styles() {
    ?>
    <style>
        .category-tree {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }
        
        .category-tree-item {
            margin-bottom: 5px;
        }
        
        .category-tree-link {
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
            display: block;
            border-radius: 3px;
            transition: background 0.3s;
        }
        
        .category-tree-link:hover {
            background: #f8f9fa;
            color: #c77022;
        }
        
        .category-tree .category-tree {
            padding-left: 20px;
            margin-top: 5px;
        }
        
        .category-count {
            color: #666;
            font-size: 0.9em;
        }
        
        .popular-categories-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .popular-category-item {
            margin-bottom: 8px;
        }
        
        .popular-category-item a {
            text-decoration: none;
            color: #333;
            padding: 8px 12px;
            display: block;
            background: #f8f9fa;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .popular-category-item a:hover {
            background: #c77022;
            color: white;
        }
        
        .category-breadcrumbs {
            margin-bottom: 20px;
        }
        
        .breadcrumb-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }
        
        .breadcrumb-list li {
            margin-right: 5px;
        }
        
        .breadcrumb-list .separator {
            color: #666;
            margin: 0 5px;
        }
        
        .breadcrumb-list a {
            color: #c77022;
            text-decoration: none;
        }
        
        .breadcrumb-list a:hover {
            text-decoration: underline;
        }
        
        .breadcrumb-list .current {
            color: #333;
            font-weight: bold;
        }
    </style>
    <?php
}
?>
