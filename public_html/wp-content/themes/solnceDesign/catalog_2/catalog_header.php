<?php
// catalog_header.php

// Загружаем опции фильтров
$color_options = get_child_categories('col');
$style_options = get_child_categories('style');
$material_options = get_child_categories('materials');

// Получаем все категории для JS
$all_categories = get_categories(array(
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => false,
));
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
?>

<div class="block_padding_60"></div>
<div class="header_block">
    <h2 class="title">Товары с фильтрацией</h2>
    <hr class="title__under">
</div>
<div class="block_padding_60"></div>

<div class="category-filter-wrapper">
    <div class="category-filter">
        <h3>Фильтр по товарам:</h3>
        <div class="filter-controls">
            <select id="parent-category-filter" class="filter-select">
                <option value="">Все категории</option>
                <?php
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

<div class="products-container">
    <div id="products-list" class="products-grid">
        <!-- Товары будут загружаться сюда через AJAX -->
        <div class="loading">Загрузка...</div>
    </div>
    <div id="pagination-container">
        <!-- Пагинация будет добавляться сюда через AJAX -->
    </div>
</div>

<!-- Передаем URL для AJAX в JS -->
<script>
    const ajaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
    const postsPerPage = 20;
    const categoriesData = <?php echo json_encode($js_categories); ?>;
</script>