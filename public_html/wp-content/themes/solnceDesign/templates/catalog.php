<?php



// Определяем имя функции
$func_name = 'get_child_categories';

// Проверяем, существует ли функция
if (!function_exists($func_name)) {

    function get_child_categories()
    {
        // Логируем стек вызовов при первом объявлении
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10);
        $log_message = "[" . date('Y-m-d H:i:s') . "] get_child_categories объявлена впервые\n";
        foreach ($trace as $i => $call) {
            $file = isset($call['file']) ? $call['file'] : '[PHP internal]';
            $line = isset($call['line']) ? $call['line'] : '';
            $func = isset($call['function']) ? $call['function'] : '';
            $log_message .= "#$i $func() в $file:$line\n";
        }
        file_put_contents(__DIR__ . '/function_calls.log', $log_message . "\n", FILE_APPEND);

        // Твоя реальная логика функции
        return []; // пример
    }

} else {
    // Если функция уже существует — логируем факт повторного объявления
    $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10);
    $log_message = "[" . date('Y-m-d H:i:s') . "] Дубликат get_child_categories! Уже объявлена.\n";
    foreach ($trace as $i => $call) {
        $file = isset($call['file']) ? $call['file'] : '[PHP internal]';
        $line = isset($call['line']) ? $call['line'] : '';
        $func = isset($call['function']) ? $call['function'] : '';
        $log_message .= "#$i $func() в $file:$line\n";
    }
    file_put_contents(__DIR__ . '/function_calls.log', $log_message . "\n", FILE_APPEND);
}



if (!function_exists('get_child_categories')) {
    function get_child_categories($parent_slug, $taxonomy = 'category')
    {
        $parent_category = get_term_by('slug', $parent_slug, $taxonomy);
        if (!$parent_category) {
            return [];
        }

        $child_categories = get_terms(array(
            'taxonomy' => $taxonomy,
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false,
            'parent' => $parent_category->term_id
        ));

        $options = [];
        if (!is_wp_error($child_categories)) {
            foreach ($child_categories as $category) {
                $options[$category->slug] = $category->name;
            }
        }

        return $options;
    }
}

// Получаем опции фильтров из WordPress категорий
// Примеры использования:
// Для стандартных категорий WordPress:


$color_options = get_child_categories('col');
$style_options = get_child_categories('style');
$material_options = get_child_categories('materials');

// Функция для получения дочерних терминов из произвольной таксономии
if (!function_exists('get_child_terms')) {
    function get_child_terms($parent_slug, $taxonomy = 'category')
    {
        $parent_term = get_term_by('slug', $parent_slug, $taxonomy);
        if (!$parent_term) {
            return [];
        }
        $child_terms = get_terms(array(
            'taxonomy' => $taxonomy,
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false,
            'parent' => $parent_term->term_id
        ));
        $options = [];
        if (!is_wp_error($child_terms)) {
            foreach ($child_terms as $term) {
                $options[$term->slug] = $term->name;
            }
        }
        return $options;
    }
}



// Если категории не найдены, используем fallback значения
if (empty($color_options)) {
    $color_options = [
        'белый' => 'Белый',
        'черный' => 'Черный',
        'серый' => 'Серый',
        'коричневый' => 'Коричневый',
        'бежевый' => 'Бежевый',
        'красный' => 'Красный',
        'синий' => 'Синий',
        'зеленый' => 'Зеленый',
        'желтый' => 'Желтый',
        'фиолетовый' => 'Фиолетовый',
        'оранжевый' => 'Оранжевый',
        'розовый' => 'Розовый',
        'золотой' => 'Золотой',
        'серебряный' => 'Серебряный',
        'другой' => 'Другой'
    ];
}

if (empty($style_options)) {
    $style_options = [
        'классический' => 'Классический',
        'современный' => 'Современный',
        'минимализм' => 'Минимализм',
        'лофт' => 'Лофт',
        'скандинавский' => 'Скандинавский',
        'прованс' => 'Прованс',
        'кантри' => 'Кантри',
        'винтаж' => 'Винтаж',
        'арт-деко' => 'Арт-деко',
        'хай-тек' => 'Хай-тек',
        'эко' => 'Эко',
        'индустриальный' => 'Индустриальный',
        'барокко' => 'Барокко',
        'ренессанс' => 'Ренессанс',
        'другой' => 'Другой'
    ];
}

if (empty($material_options)) {
    $material_options = [
        'дерево' => 'Дерево',
        'металл' => 'Металл',
        'стекло' => 'Стекло',
        'пластик' => 'Пластик',
        'ткань' => 'Ткань',
        'кожа' => 'Кожа',
        'камень' => 'Камень',
        'керамика' => 'Керамика',
        'мрамор' => 'Мрамор',
        'гранит' => 'Гранит',
        'бетон' => 'Бетон',
        'бамбук' => 'Бамбук',
        'ротанг' => 'Ротанг',
        'винил' => 'Винил',
        'другой' => 'Другой'
    ];
}
?>
<?php
// Функция для генерации опций select
if (!function_exists('generate_select_options')) {
    function generate_select_options($options, $default_text)
    { ?>
        <option value=""><?php echo esc_html($default_text); ?></option>
        <?php foreach ($options as $value => $label): ?>
            <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
        <?php endforeach ?>
    <?php }
} ?>

<?php
// Функция для получения категорий товара по типу
if (!function_exists('get_category_by_type')) {
    function get_category_by_type($category_id, $type, $taxonomy = 'category')
    {
        $category = get_term($category_id, $taxonomy);
        if (!$category || is_wp_error($category))
            return '';

        // Получаем все родительские категории
        $parent_categories = get_ancestors($category_id, $taxonomy);

        // Ищем родительскую категорию нужного типа
        foreach ($parent_categories as $parent_id) {
            $parent = get_term($parent_id, $taxonomy);
            if ($parent && !is_wp_error($parent) && $parent->slug === $type) {
                return $category->slug; // Возвращаем слаг дочерней категории
            }
        }

        return '';
    }
}
?>



<div class="header_block">
    <h2 class="title">Товары с фильтрацией</h2>
    <hr class="title__under">
</div>

<div class="block_padding_60"></div>

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
                <?php generate_select_options($color_options, 'Все цвета'); ?>
            </select>

            <select id="style-filter" class="filter-select">
                <?php generate_select_options($style_options, 'Все стили'); ?>
            </select>

            <select id="material-filter" class="filter-select">
                <?php generate_select_options($material_options, 'Все материалы'); ?>
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
                    data-price="<?php echo $price_value; ?>" data-title="<?php echo esc_attr(strtolower($post_title)); ?>">

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

                        <div class="product-meta">
                            <span class="product-date"><?php echo esc_html($post_date); ?></span>
                        </div>
                    </div>

                    <div class="product-actions">
                        <a href="<?php echo esc_url($post_link); ?>" class="product-link btn">Подробнее</a>
                    </div>
                </div>
            <?php endwhile ?>
            <?php wp_reset_postdata();
        else: ?>
            <div class="no-products">
                <p>Товары не найдены.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
SSS


<script>
    // Данные о категориях для JavaScript

    const categoriesData = <?php
    $js_categories = array();
    foreach ($all_categories as $cat) {
        if ($cat->slug !== 'templates') {
            $js_categories[] = array(
                'id' => $cat->term_id,
                'name' => $cat->name,
                'parent' => $cat->parent
            );
        }
    }
    echo json_encode($js_categories);
    ?>;
    document.addEventListener("DOMContentLoaded", startCatalogFiltr);

    function startCatalogFiltr() {
        const parentFilter = document.getElementById('parent-category-filter');
        const subcategoryFilter = document.getElementById('subcategory-filter');
        const colorFilter = document.getElementById('color-filter');
        const styleFilter = document.getElementById('style-filter');
        const materialFilter = document.getElementById('material-filter');
        const clearFiltersBtn = document.getElementById('clear-filters');
        const productItems = document.querySelectorAll('.product-item');




        // Массив всех фильтров для удобства
        const filters = [parentFilter, subcategoryFilter, colorFilter, styleFilter, materialFilter];

        // Добавляем обработчики событий для всех фильтров
        filters.forEach(filter => {
            filter.addEventListener('change', function () {
                if (this === parentFilter) {
                    updateSubcategories();
                }
                filterProducts();
            });
        });

        // Функция обновления подкатегорий
        function updateSubcategories() {
            const parentId = parentFilter.value;
            subcategoryFilter.innerHTML = '<option value="">Выберите подкатегорию</option>';

            if (parentId) {
                subcategoryFilter.disabled = false;
                const subcategories = categoriesData.filter(cat => cat.parent == parentId);
                subcategories.forEach(cat => {
                    const option = document.createElement('option');
                    option.value = cat.id;
                    option.textContent = cat.name;
                    subcategoryFilter.appendChild(option);
                });
            } else {
                subcategoryFilter.disabled = true;
            }
        }

        // Функция фильтрации товаров
        function filterProducts() {
            const filterValues = {
                parent: parentFilter.value,
                subcategory: subcategoryFilter.value,
                color: colorFilter.value.toLowerCase(),
                style: styleFilter.value.toLowerCase(),
                material: materialFilter.value.toLowerCase()
            };

            let visibleCount = 0;

            productItems.forEach(item => {
                const itemData = {
                    postId: item.dataset.postId,
                    color: item.dataset.color.toLowerCase(),
                    style: item.dataset.style.toLowerCase(),
                    material: item.dataset.material.toLowerCase()
                };

                let show = true;

                // Фильтры по атрибутам (цвет, стиль, материал) - обязательные совпадения
                const attributeFilters = ['color', 'style', 'material'];
                for (const attr of attributeFilters) {
                    if (filterValues[attr] && itemData[attr] && itemData[attr] !== '') {
                        // Точное совпадение для атрибутов
                        show = itemData[attr] === filterValues[attr];
                        if (!show) break;
                    }
                }

                // Фильтр по категориям
                if (show && (filterValues.parent || filterValues.subcategory)) {
                    const itemCategoryIds = item.dataset.categoryIds ? item.dataset.categoryIds.split(',') : [];
                    let categoryMatch = false;

                    if (filterValues.subcategory) {
                        // Если выбрана подкатегория, проверяем точное совпадение
                        categoryMatch = itemCategoryIds.includes(filterValues.subcategory);
                    } else if (filterValues.parent) {
                        // Если выбрана родительская категория, проверяем, есть ли она или ее потомки
                        categoryMatch = itemCategoryIds.some(id => {
                            const catId = parseInt(id);
                            // Проверяем, является ли категория потомком выбранной родительской
                            return categoriesData.some(cat => cat.id == catId && (cat.id == filterValues.parent || cat.parent == filterValues.parent));
                        });
                    }

                    if (!categoryMatch) {
                        show = false;
                    }
                }

                if (show) {
                    item.classList.remove('hidden');
                    visibleCount++;
                } else {
                    item.classList.add('hidden');
                }
            });

            // Показываем/скрываем сообщение "не найдено"
            let noResultsMsg = document.querySelector('.no-results');

            if (visibleCount === 0) {
                if (!noResultsMsg) {
                    noResultsMsg = document.createElement('div');
                    noResultsMsg.className = 'no-results';
                    noResultsMsg.textContent = 'Товары не найдены по заданным критериям';
                    document.getElementById('products-list').appendChild(noResultsMsg);
                }
            } else if (noResultsMsg) {
                noResultsMsg.remove();
            }
        }

        // Сброс фильтров
        clearFiltersBtn.addEventListener('click', function () {
            // Сбрасываем все фильтры
            filters.forEach(filter => {
                filter.value = '';
            });

            // Сбрасываем подкатегории
            subcategoryFilter.disabled = true;
            subcategoryFilter.innerHTML = '<option value="">Выберите подкатегорию</option>';

            // Показываем все товары
            productItems.forEach(item => {
                item.classList.remove('hidden');
            });

            // Удаляем сообщение "не найдено"
            const noResultsMsg = document.querySelector('.no-results');
            if (noResultsMsg) {
                noResultsMsg.remove();
            }
        });
    };

</script>
<div class="block_padding_40"></div>