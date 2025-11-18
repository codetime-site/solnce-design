<?php
// functions.php

// Хук для AJAX (для авторизованных пользователей)
add_action('wp_ajax_load_catalog_products', 'ajax_load_catalog_products');
// Хук для AJAX (для неавторизованных пользователей - если нужно)
add_action('wp_ajax_nopriv_load_catalog_products', 'ajax_load_catalog_products');

function ajax_load_catalog_products()
{
    // Проверяем nonce, если используется (необязательно, но безопаснее)
    // if (!wp_verify_nonce($_POST['nonce'], 'load_products_nonce')) {
    //     wp_die('Security check failed');
    // }

    // Получаем параметры из AJAX-запроса
    $paged = intval($_POST['page'] ?? 1);
    $posts_per_page = intval($_POST['posts_per_page'] ?? 20);

    // Фильтры
    $category = intval($_POST['category'] ?? 0);
    $sub_category = intval($_POST['sub_category'] ?? 0);
    $color = sanitize_text_field($_POST['color'] ?? '');
    $style = sanitize_text_field($_POST['style'] ?? '');
    $material = sanitize_text_field($_POST['material'] ?? '');

    // Подготавливаем аргументы для WP_Query
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    // Исключить категорию 'templates'
    $templates_category = get_term_by('slug', 'templates', 'category');
    if ($templates_category && !is_wp_error($templates_category)) {
        $args['category__not_in'] = array($templates_category->term_id);
    }

    // Массив таксономий для фильтрации
    $tax_query = array('relation' => 'AND');

    // Фильтр по категории
    if ($sub_category) {
        $tax_query[] = array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => $sub_category,
        );
    } elseif ($category) {
        // Если выбрана родительская, ищем все подкатегории + саму родительскую
        $sub_cats = get_term_children($category, 'category');
        $all_cats = array_merge(array($category), $sub_cats);
        $tax_query[] = array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => $all_cats,
            'operator' => 'IN',
        );
    }

    // Фильтры по цвету, стилю, материалу
    if ($color) {
        $tax_query[] = array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $color,
        );
    }
    if ($style) {
        $tax_query[] = array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $style,
        );
    }
    if ($material) {
        $tax_query[] = array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $material,
        );
    }

    if (count($tax_query) > 1) {
        $args['tax_query'] = $tax_query;
    }

    $products_query = new WP_Query($args);

    // Выводим только HTML для товаров
    if ($products_query->have_posts()) {
        while ($products_query->have_posts()) {
            $products_query->the_post();
            $post_id = get_the_ID();
            $post_title = get_the_title();
            $post_excerpt = get_the_excerpt();
            $post_link = get_permalink();
            $post_date = get_the_date();

            // Получаем изображение из ACF (замените 'image' на имя вашего поля)

            $image = '';
            if (have_rows('flex_page', $post_id)) {
                while (have_rows('flex_page', $post_id)) { the_row();
                    if (get_row_layout() == 'hero') {
                        $images = get_sub_field('back_img');
                        $class_name = get_sub_field('smallbig') ? "hero__backImg_light" : null;
                        $class_color = get_sub_field('catalog_color') ?: null;

                        if ($images) {
                            // Если back_img - массив изображений, берем первое
                            if (is_array($images) && !empty($images))
                                $image = $images['sizes']['medium'];
                            else
                                $image = $images;

                        }
                        break; // Берем первое найденное изображение
                    }
                }
            }


            // $image = get_field('image', $post_id);
            // $thumbnail = '';
            // if ($image) {
            //     if (is_array($image)) {
            //         $thumbnail = esc_url($image['url']);
            //     } else {
            //         $thumbnail = esc_url($image);
            //     }
            // }
            // if (!$thumbnail) {
            //     $thumbnail = get_template_directory_uri() . '/assets/img/placeholder.jpg';
            // }

            // Получаем цену из ACF (замените 'price' на имя вашего поля)
            $price = get_field('price', $post_id);
            $price_value = $price ? floatval($price) : 0;

            // Получаем категории
            $post_categories = get_the_category($post_id);

            // Извлекаем атрибуты из категорий
            $product_color = '';
            $product_style = '';
            $product_material = '';
            foreach ($post_categories as $cat) {
                if (get_category_by_type($cat->term_id, 'col', 'category')) {
                    $product_color = get_category_by_type($cat->term_id, 'col', 'category');
                }
                if (get_category_by_type($cat->term_id, 'style', 'category')) {
                    $product_style = get_category_by_type($cat->term_id, 'style', 'category');
                }
                if (get_category_by_type($cat->term_id, 'materials', 'category')) {
                    $product_material = get_category_by_type($cat->term_id, 'materials', 'category');
                }
            }

            // Fallback к мета-полям
            if (empty($product_color)) {
                $product_color = get_post_meta($post_id, 'col', true) ?: '';
            }
            if (empty($product_style)) {
                $product_style = get_post_meta($post_id, 'style', true) ?: '';
            }
            if (empty($product_material)) {
                $product_material = get_post_meta($post_id, 'materials', true) ?: '';
            }

            // --- ВАШ HTML КОМПОНЕНТ ТОВАРА ---
            // Замените этот блок на ваш компонент из `caltalog_flex_component.php` или его эквивалент
            // Я использую упрощённый пример, как в вашем коде
            $class_name = 'default-class'; // Замените на реальное значение
            $class_color = '#ffffff'; // Замените на реальное значение

            ?>
            <div class="product-item" data-post-id="<?php echo $post_id; ?>"
                data-category-ids="<?php echo esc_attr(implode(',', array_column($post_categories, 'term_id'))); ?>"
                data-color="<?php echo esc_attr(strtolower($product_color)); ?>"
                data-style="<?php echo esc_attr(strtolower($product_style)); ?>"
                data-material="<?php echo esc_attr(strtolower($product_material)); ?>" data-price="<?php echo $price_value; ?>"
                data-title="<?php echo esc_attr(strtolower($post_title)); ?>">
                <div class="product-image <?php echo esc_attr($class_name) ?>" <?php if ($class_color): ?>
                        style="background: <?php echo $class_color; ?>;" <?php endif ?>>
                    <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($post_title); ?>">
                </div>
                <div class="product-content">
                    <h3 class="product-title">
                        <a href="<?php echo esc_url($post_link); ?>"><?php echo esc_html($post_title); ?></a>
                    </h3>
                    <?php if ($price): ?>
                        <div class="product-price"><?php echo number_format($price_value, 0, ',', ' '); ?> руб.</div>
                    <?php endif; ?>
                    <?php if ($post_excerpt): ?>
                        <div class="product-excerpt"><?php echo wp_trim_words($post_excerpt, 20); ?></div>
                    <?php endif; ?>
                </div>
                <div class="product-actions">
                    <a href="<?php echo esc_url($post_link); ?>" class="product-link btn">Подробнее</a>
                </div>
            </div>
            <?php
        }
        wp_reset_postdata();
    } else {
        echo '<div class="no-products"><p>Товары не найдены.</p></div>';
    }

    // Выводим общее количество найденных постов (для пагинации на фронте)
    echo '<!--TOTAL_POSTS-->' . $products_query->found_posts . '<!--/TOTAL_POSTS-->';

    wp_die(); // Всегда завершаем AJAX-запрос с wp_die()
}

// Функция из catalog_func.php (для использования в AJAX)
function get_category_by_type($category_id, $type, $taxonomy = 'category')
{
    $category = get_term($category_id, $taxonomy);
    if (!$category || is_wp_error($category))
        return '';
    $parent_categories = get_ancestors($category_id, $taxonomy);
    foreach ($parent_categories as $parent_id) {
        $parent = get_term($parent_id, $taxonomy);
        if ($parent && !is_wp_error($parent) && $parent->slug === $type)
            return $category->slug;
    }
    return '';
}

?>