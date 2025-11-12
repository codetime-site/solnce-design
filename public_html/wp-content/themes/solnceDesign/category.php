<?php get_header(); ?>

<?php
//  Template Name: etette_catalog
// Функция для получения дочерних категорий из родительской

require_once get_template_directory() . "/templates/catalog/catalog_func.php"; ?>
<main id="main">

    <?php require_once get_template_directory() . "/templates/catalog/catalog_flex_header.php"; ?>

    <div class="container">
        <div class="block_padding_60"></div>

        <div class="header_block">
            <h2 class="title">Товары с фильтрацией</h2>
            <hr class="title__under">
        </div>

        <div class="block_padding_60"></div>

        <!-- Фильтр категорий -->
        <!-- 
        🛠️ ИНСТРУКЦИЯ ПО НАСТРОЙКЕ ФИЛЬТРОВ
        
        ВАРИАНТ 1: Стандартные категории WordPress
        Создайте в WordPress следующие родительские категории:
        1. "Цвета" (slug: col) с дочерними: Белый, Черный, Серый и т.д.
        2. "Стили" (slug: style) с дочерними: Классический, Современный и т.д.  
        3. "Материалы" (slug: materials) с дочерними: Дерево, Металл и т.д.
        
        Затем назначьте товары/категории к соответствующим дочерним категориям.
        -->

        <!-- фильтр по товарам -->
        <div class="category-filter-wrapper">
            <div class="category-filter">
                <h3>Фильтр по товарам:</h3>
                <div class="filter-controls">
                    <select id="parent-category-filter" class="filter-select">
                        <option value="">Все категории</option>
                        <?php
                        // Получаем все категории одним запросом
                        $all_categories = get_categories(array(
                            'orderby' => 'name',
                            'order' => 'ASC',
                            'hide_empty' => false
                        ));

                        foreach ($all_categories as $cat) {
                            if ($cat->slug !== 'templates' && $cat->parent == 0) {
                                echo '<option value="' . $cat->term_id . '">' . esc_html($cat->name) . '</option>';
                            }
                        }
                        ?>
                    </select>

                    <select id="subcategory-filter" class="filter-select" disabled style="display:none">
                        <option value="">Выберите подкатегорию</option>
                    </select>

                    <select id="color-filter" class="filter-select">
                        <?php echo generate_select_options($color_options, 'Все цвета'); ?>
                    </select>

                    <select id="style-filter" class="filter-select">
                        <?php echo generate_select_options($style_options, 'Все стили'); ?>
                    </select>

                    <select id="material-filter" class="filter-select">
                        <?php echo generate_select_options($material_options, 'Все материалы'); ?>
                    </select>

                    <button id="clear-filters" class="clear-filters-btn">Сбросить фильтры</button>
                </div>
            </div>
        </div>

        <!-- Список товаров -->
        <div class="products-container">
            <div id="products-list" class="products-grid">
                <?php

                // опеределенеи текуший страниецу 
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;

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

                if ($products_query->have_posts()):
                    while ($products_query->have_posts()):
                        $products_query->the_post();

                        $post_id = get_the_ID();
                        $post_title = get_the_title();
                        $post_excerpt = get_the_excerpt();
                        $post_link = get_permalink();
                        $post_date = get_the_date();

                        $image = '';
                        if (have_rows('flex_page', $post_id)) {
                            while (have_rows('flex_page', $post_id)) {
                                the_row();
                                if (get_row_layout() == 'hero') {
                                    $images = get_sub_field('back_img');
                                    $class_name = get_sub_field('smallbig') ? "hero__backImg_light" : null;
                                    $class_color = get_sub_field('catalog_color') ?: null;

                                    if ($images) {
                                        // Если back_img - массив изображений, берем первое
                                        if (is_array($images) && !empty($images)) {
                                            $image = $images['sizes']['medium'];
                                        } else {
                                            $image = $images;
                                        }
                                    }
                                    break; // Берем первое найденное изображение
                                }
                            }
                        }

                        // Получаем категории поста
                        $post_categories = get_the_category($post_id);

                        // Извлекаем атрибуты из категорий поста
                        $product_color = '';
                        $product_style = '';
                        $product_material = '';

                        foreach ($post_categories as $cat) {
                            $color = get_category_by_type($cat->term_id, 'col');
                            $style = get_category_by_type($cat->term_id, 'style');
                            $material = get_category_by_type($cat->term_id, 'materials');

                            if (!empty($color))
                                $product_color = $color;
                            if (!empty($style))
                                $product_style = $style;
                            if (!empty($material))
                                $product_material = $material;
                        }

                        // Fallback к мета-полям поста
                        if (empty($product_color)) {
                            $product_color = get_post_meta($post_id, 'col', true) ?: '';
                        }
                        if (empty($product_style)) {
                            $product_style = get_post_meta($post_id, 'style', true) ?: '';
                        }
                        if (empty($product_material)) {
                            $product_material = get_post_meta($post_id, 'materials', true) ?: '';
                        }

                        // Получаем изображение из ACF
                        $thumbnail = '';
                        if ($image) {
                            if (is_array($image)) {
                                $thumbnail = esc_url($image['url']);
                            } else {
                                $thumbnail = esc_url($image);
                            }
                        }
                        if (!$thumbnail) {
                            $thumbnail = get_template_directory_uri() . '/assets/img/placeholder.jpg';
                        }

                        // Получаем цену из ACF
                        $price = get_field('price', $post_id);
                        $price_value = $price ? floatval($price) : 0;
                        ?>

                        <div class="product-item" data-post-id="<?php echo $post_id; ?>"
                            data-category-ids="<?php echo esc_attr(implode(',', array_column($post_categories, 'term_id'))); ?>"
                            data-color="<?php echo esc_attr(strtolower($product_color)); ?>"
                            data-style="<?php echo esc_attr(strtolower($product_style)); ?>"
                            data-material="<?php echo esc_attr(strtolower($product_material)); ?>"
                            data-price="<?php echo $price_value; ?>"
                            data-title="<?php echo esc_attr(strtolower($post_title)); ?>">

                            <div class="product-image <?php echo esc_attr($class_name) ?>" <?php if ($class_color): ?>
                                    style="background: <?php echo $class_color; ?>;" <?php endif ?>">
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
                    <?php endwhile ?>

                    <div class="pagination">
                        <? php/*
         echo paginate_links([
             'total' => $products_query->max_num_pages,
             'current' => $paged,
             'prev_text' => '&laquo; Назад',
             'next_text' => 'Вперёд &raquo;',
         ]);*/
                            ?>
                    </div>

                    <?php wp_reset_postdata();
                else: ?>
                    <div class="no-products">
                        <p>Товары не найдены.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
    require_once get_template_directory() . "/templates/catalog/catalog_flex_footer.php";
    require_once get_template_directory() . "/templates/catalog/catalog_script.php";
    ?>
</main>

<div class="block_padding_40"></div>
<?php get_footer(); ?>