<div class="parent_cat">
    <div class="container">
        <div class="splide parent_cat__contant" role="group" aria-label="this Slide cat">
            <?php get_template_part("templates/logic_section/send_title"); ?>
            <div class="splide__track">
                <?php if (have_rows("rep_cat")): ?>
                    <ul class="splide__list">
                        <?php while(have_rows("rep_cat")):the_row();
                            $link = get_sub_field('link');
                            $titles = get_sub_field('title');
                            $imgs = get_sub_field('img');
                            ?>
                            <li class="splide__slide">
                                <a href="<?php echo esc_url($link); ?>" class="card">
                                    <div class="card__image-wrapper">
                                        <img src="<?php echo esc_url($imgs); ?>" alt="Изображение 1" class="card__image">
                                    </div>
                                    <h3 class="card__title"><?php echo esc_html($titles); ?></h3>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


