<?php
/*
Template Name: Categories Page
Template Post Type: page
*/
get_header();
?>

<main id="main">
    <div class="container">
        <?php $categories = get_categories(array(
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false,
            // 'parent' => 0 // Только родительские категории/
        )); ?>

        <div class="header_block">
            <h2 class="title">Категории</h2>
            <hr class="title__under">
        </div>


        <div class="block_padding_60"></div>
        <?php if (!empty($categories)): ?>
            <div class="category">
                <ul class="category__list">
                    <?php foreach ($categories as $category): ?>
                        <?php if ($category->slug !== 'templates'): ?>

                            <?php
                            $cat_link = esc_url(get_category_link($category->term_id));
                            $cat_name = esc_html($category->name);
                            $cat_description = esc_html($category->description);
                            $cat_count = $category->count;

                            // Получаем поля ACF для категории
                            $category_image = get_field('img', 'category_' . $category->term_id); // Поле изображения (предполагаем Array)
                            ?>
                            <div class="category-item">
                                <?php if ($category_image): ?>
                                    <div class="category-item-image">
                                        <!-- // Если изображение — массив (Array format в ACF) -->
                                        <?php if (is_array($category_image)): ?>
                                            <?php $img_url = esc_url($category_image['url']); ?>
                                            <?php $img_alt = esc_attr($category_image['alt'] ?? $cat_name); // Fallback alt ?>
                                            // Если изображение — строка (URL) ?>
                                        <?php else: ?>
                                            <?php $img_url = esc_url($category_image); ?>
                                            <?php $img_alt = esc_attr($cat_name); // Fallback alt ?>
                                        <?php endif; ?>
                                        <img src="<?php echo $img_url; ?>" alt="<?php echo $img_alt; ?>">
                                    </div>
                                <?php endif; ?>

                                <div class="category-item-title">

                                    <a href="<?php echo $cat_link; ?>"><?php echo $cat_name; ?></a>
                                    <?php if ($cat_count > 0): ?>
                                        <span style="font-size:0.9rem; color:#888;"> (<?php echo $cat_count; ?> постов)</span>
                                    <?php endif; ?>
                                </div>

                                <button class="category_item btn_win btn">
                                    <a class="category-item-link" href="<?php echo $cat_link; ?>">Перейти</a>
                                </button>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>

                <?php else: ?>
                    <p style="text-align:center;">Категорий не найдено.</p>
                </ul>
            </div>
        <?php endif; ?>
        <?php
        // Если нужно вывести дочерние категории в иерархии, раскомментируйте и адаптируйте:
        /*
        foreach ($categories as $parent) {
            if ($parent->slug !== 'templates' && !empty($parent->children)) {
                echo '<div class="subcategories">';
                foreach ($parent->children as $child) {
                    if ($child->slug !== 'templates') {
                        echo '<h3><a href="' . esc_url(get_category_link($child->term_id)) . '">' . esc_html($child->name) . '</a></h3>';
                    }
                }
                echo '</div>';
            }
        }
        */
        ?>
    </div>
</main>

<?php get_footer(); ?>


<style>
    ul.category__list {
        display: flex;
        flex-wrap: wrap;
        /* background: red; */
        gap: 15px;
        justify-content: center;
        color: black;

    }

    .category-item-title a {
        font-size: 1.5rem;
        font-weight: 600;
        color: black;
        text-decoration: none;
    }

    .category-item-image {
        width: 100px;
        height: 100px;
        /* height: auto; */
        border-radius: 50%;
        overflow: hidden;
        border: 2px #c77022 solid;

    }

    .category-item-image img {
        object-fit: cover;
        /* max-width: 100%; */
        width: 100%;
        height: 100%;
    }

    .category-item {
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        border-radius: 15px;
        border: 2px red solid;
        padding: 15px;

        max-width: 300px;
        min-width: 220px;

    }
</style>