<?php 
// Подключаем скрипт фильтра каталога


wp_enqueue_script(
    'catalog-filter',
    get_template_directory_uri() . '/assets/js/catalog-filter.js',
    array('jquery'),
    filemtime(get_template_directory() . '/assets/js/catalog-filter.js'),
    true
);

wp_localize_script('catalog-filter', 'vpCatalogData', array(
    'ajax_url' => admin_url('admin-ajax.php'),
    'posts_per_page' => 20,
    'categories' => array_map(function($cat){
        return [
            'id' => $cat->term_id,
            'name' => $cat->name,
            'parent' => $cat->parent
        ];
    }, get_categories(array('hide_empty'=>false))),
));

function vp_enqueue_catalog_scripts() {
    wp_enqueue_script(
        'catalog-filter',
        get_template_directory_uri() . '/assets/scripts/catalog-filter.js',
        array('jquery'),
        filemtime(get_template_directory() . '/assets/scripts/catalog-filter.js'),
        true
    );

    wp_localize_script('catalog-filter', 'vpCatalogData', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'posts_per_page' => 20, // количество товаров на странице
    ));
}
add_action('wp_enqueue_scripts', 'vp_enqueue_catalog_scripts');

// AJAX обработчик
function vp_ajax_filter_products() {
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 20;

    $tax_query = array('relation' => 'AND');

    // Фильтры по категориям
    if (!empty($_POST['parent'])) {
        $parent_id = intval($_POST['parent']);
        if (!empty($_POST['subcategory'])) {
            $tax_query[] = array(
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => intval($_POST['subcategory']),
                'include_children' => false,
            );
        } else {
            $tax_query[] = array(
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => $parent_id,
                'include_children' => true,
            );
        }
    }

    // Фильтры по атрибутам (цвет, стиль, материал)
    $meta_query = array('relation' => 'AND');

    if (!empty($_POST['color'])) {
        $meta_query[] = array(
            'key' => 'col',
            'value' => sanitize_text_field($_POST['color']),
            'compare' => '='
        );
    }
    if (!empty($_POST['style'])) {
        $meta_query[] = array(
            'key' => 'style',
            'value' => sanitize_text_field($_POST['style']),
            'compare' => '='
        );
    }
    if (!empty($_POST['material'])) {
        $meta_query[] = array(
            'key' => 'materials',
            'value' => sanitize_text_field($_POST['material']),
            'compare' => '='
        );
    }

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'tax_query' => $tax_query,
        'meta_query' => $meta_query,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $products_query = new WP_Query($args);

    ob_start();
    if ($products_query->have_posts()) :
        while ($products_query->have_posts()) : $products_query->the_post();
            $post_id = get_the_ID();
            $post_title = get_the_title();
            $post_link = get_permalink();
            $price = get_field('price', $post_id);
            $price_value = $price ? floatval($price) : 0;

            $thumbnail = get_the_post_thumbnail_url($post_id, 'medium');
            if (!$thumbnail) {
                $thumbnail = get_template_directory_uri() . '/assets/img/placeholder.jpg';
            }

            ?>
            <div class="product-item">
                <div class="product-image">
                    <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($post_title); ?>">
                </div>
                <div class="product-content">
                    <h3 class="product-title"><a href="<?php echo esc_url($post_link); ?>"><?php echo esc_html($post_title); ?></a></h3>
                    <?php if ($price): ?>
                        <div class="product-price"><?php echo number_format($price_value, 0, ',', ' '); ?> руб.</div>
                    <?php endif; ?>
                </div>
            </div>
            <?php
        endwhile;
    else:
        echo '<div class="no-products">Товары не найдены.</div>';
    endif;
    wp_reset_postdata();

    $html = ob_get_clean();

    wp_send_json_success(array(
        'html' => $html,
        'max_pages' => $products_query->max_num_pages,
    ));
}
add_action('wp_ajax_filter_products', 'vp_ajax_filter_products');
add_action('wp_ajax_nopriv_filter_products', 'vp_ajax_filter_products');
