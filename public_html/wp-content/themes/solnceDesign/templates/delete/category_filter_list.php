<div class="categories-container">
    <div id="categories-list" class="category">
        <ul class="category__list">
            <?php
            $categories = get_categories(array(
                'orderby' => 'name',
                'order' => 'ASC',
                'hide_empty' => false,
            ));

            if (!empty($categories)):
                foreach ($categories as $category):
                    if ($category->slug !== 'templates'):
                        $cat_link = esc_url(get_category_link($category->term_id));
                        $cat_name = esc_html($category->name);
                        $cat_description = esc_html($category->description);
                        $cat_count = $category->count;
                        $parent_id = $category->parent;

                        // Получаем поля ACF для категории
                        $category_image = get_field('img', 'category_' . $category->term_id);
                        ?>
                        <div class="category-item" data-parent="<?php echo $parent_id; ?>"
                            data-category-id="<?php echo $category->term_id; ?>">
                            <?php if ($category_image): ?>
                                <div class="category-item-image">
                                    <?php if (is_array($category_image)): ?>
                                        <?php $img_url = esc_url($category_image['url']); ?>
                                        <?php $img_alt = esc_attr($category_image['alt'] ?? $cat_name); ?>
                                    <?php else: ?>
                                        <?php $img_url = esc_url($category_image); ?>
                                        <?php $img_alt = esc_attr($cat_name); ?>
                                    <?php endif; ?>
                                    <img src="<?php echo $img_url; ?>" alt="<?php echo $img_alt; ?>">
                                </div>
                            <?php endif; ?>

                            <div class="category-item-content">
                                <div class="category-item-title">
                                    <a href="<?php echo $cat_link; ?>"><?php echo $cat_name; ?></a>
                                    <?php if ($cat_count > 0): ?>
                                        <span class="category-count">(<?php echo $cat_count; ?> постов)</span>
                                    <?php endif; ?>
                                    <?php if ($parent_id > 0): ?>
                                        <?php
                                        $parent_category = get_category($parent_id);
                                        if ($parent_category): ?>
                                            <span class="parent-category">→ <?php echo esc_html($parent_category->name); ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>

                                <?php if ($cat_description): ?>
                                    <div class="category-description"><?php echo $cat_description; ?></div>
                                <?php endif; ?>
                            </div>

                            <button class="category_item btn_win btn">
                                <a class="category-item-link" href="<?php echo $cat_link; ?>">Перейти</a>
                            </button>
                        </div>
                    <?php endif;
                endforeach;
            else: ?>
                <p style="text-align:center;">Категорий не найдено.</p>
            <?php endif; ?>
        </ul>
    </div>
</div>