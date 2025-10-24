<?php
$repeater = 'rep_step'; // Имя repeater-поля в ACF
$arr = [];
?>

<section class="section project">
    <div class="container">
        <div class="project__content grid_block">
            <?php get_template_part('templates/logic_section/send_title'); ?>
            <div class="block_padding_60"></div>
            <div class="project__btm grid_block_three">
                <?php if (have_rows($repeater)): ?>
                    <?php while (have_rows($repeater)):
                        the_row(); ?>
                        <?php
                        $image = get_sub_field('img'); // Получаем галерею изображений
                        $title = get_sub_field('title');
                        $sub_title = get_sub_field('sub_title');
                        $title_project = get_sub_field('title_project');
                        $sub_project = get_sub_field('sub_project');
                        $price_title = get_sub_field('price_title');
                        $price_sub = get_sub_field('price_sub');
                        $btn = get_sub_field('btn');
                        $btn_link = get_sub_field('btn_link');
                        $index = get_row_index(); // Уникальный индекс для слайдера
                        $arr = $index;
                        ?>

                        <div class="win windows__project">
                            <div class="win__top">
                                <div id="main-slider-<?php echo $index; ?>" class="splide main-slider" aria-label="project">
                                    <div class="splide__track">
                                        <ul class="splide__list">
                                            <?php if (is_array($image) && !empty($image)): ?>
                                                <?php foreach ($image as $images): ?>
                                                    <li class="splide__slide">
                                                        <div class="win__img">
                                                            <img src="<?php echo esc_url($images['sizes']['large']); ?>" alt="">
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <li class="splide__slide">
                                                    <div class="win__img">
                                                        <img src="<?php echo esc_url(wc_placeholder_img_src()); ?>"
                                                            alt="Placeholder">
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="min__pic">
                                    <div id="thumbnail-slider-<?php echo $index; ?>" class="splide thumbnail-slider"
                                        aria-label="Thumbnail Slider">
                                        <div class="splide__track">
                                            <ul class="splide__list">
                                                <?php if (is_array($image) && !empty($image)): ?>
                                                    <?php foreach ($image as $images): ?>
                                                        <li class="splide__slide">
                                                            <img src="<?php echo esc_url($images['sizes']['thumbnail']); ?>" alt="">
                                                        </li>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="win__text grid_block">
                                <?php if ($title): ?>
                                    <p class="subs_bold"><?php echo esc_html($title); ?></p>
                                <?php endif; ?>
                                <?php if ($sub_title): ?>
                                    <p class="subs"><?php echo esc_html($sub_title); ?></p>
                                <?php endif; ?>
                                <?php if ($title_project): ?>
                                    <p class="subs_bold"><?php echo esc_html($title_project); ?></p>
                                <?php endif; ?>
                                <?php if ($sub_project): ?>
                                    <p class="subs"><?php echo esc_html($sub_project); ?></p>
                                <?php endif; ?>
                                <?php if ($price_title): ?>
                                    <p class="subs_bold"><?php echo esc_html($price_title); ?></p>
                                <?php endif; ?>
                                <?php if ($price_sub): ?>
                                    <p class="subs"><?php echo esc_html($price_sub); ?></p>
                                <?php endif; ?>
                                <?php if ($btn): ?>
                                    <div class="win_btm">
                                        <button class="btn_win btn openModalBtn" data-title="<?php the_sub_field('title'); ?>"
                                            data-link="<?php the_permalink(); ?>"><?php echo esc_html($btn); ?></button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <div class=" block_padding_40">
            </div>
            <div class="block_padding_60"></div>
            <?php get_template_part('templates/logic_section/send_btn'); ?>
        </div>
    </div>
</section>