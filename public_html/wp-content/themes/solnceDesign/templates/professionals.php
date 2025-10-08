<section class="section profi">
    <div class="container">
        <?php get_template_part("templates/logic_section/send_title") ?>
        <div class="block_padding_40"></div>

        <div class="splide splide__work" id="splide__work" role="group" aria-label="Splide for worker">
            <div class="splide__track">
                <ul class="splide__list prof__btm">
                    <?php if (have_rows('rep_wokr')): ?>
                        <?php while (have_rows('rep_wokr')):
                            the_row(); ?>
                            <?php $img = get_sub_field("img"); ?>
                            <?php $skils = get_sub_field("skils"); ?>
                            <?php $name = get_sub_field("name"); ?>
                            <li class="splide__slide prof__win">
                                <!-- <div class="prof__win"> -->
                                <?php if ($img): ?>
                                    <div class="prof__img">
                                        <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($name); ?>">
                                    </div>
                                <?php endif; ?>
                                <?php if ($skils && $name): ?>
                                    <div class="prof__text">
                                        <p class="experiens"><?php echo esc_html($skils); ?></p>
                                        <p class="subs_bold"><?php echo esc_html($name); ?></p>
                                    </div>
                                <?php endif; ?>
                                <!-- </div> -->
                            </li>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

    </div>
</section>