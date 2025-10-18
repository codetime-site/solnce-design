<div class="category-filter-wrapper">
    <div class="category-filter">
        <h3>Фильтр по категориям:</h3>
        <div class="filter-controls">
            <select id="parent-category-filter" class="filter-select">
                <option value="">Все категории</option>
                <?php
                $parent_categories = get_categories(array(
                    'orderby' => 'name',
                    'order' => 'ASC',
                    'hide_empty' => false,
                    'parent' => 0
                ));
                foreach ($parent_categories as $parent_cat) {
                    if ($parent_cat->slug !== 'templates') {
                        echo '<option value="' . $parent_cat->term_id . '">' . esc_html($parent_cat->name) . '</option>';
                    }
                }
                ?>
            </select>

            <select id="subcategory-filter" class="filter-select" disabled>
                <option value="">Выберите подкатегорию</option>
            </select>

            <button id="clear-filters" class="clear-filters-btn">Сбросить фильтры</button>
        </div>
    </div>
</div>