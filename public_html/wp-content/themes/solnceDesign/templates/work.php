<?php $repeater = "rep_step"; ?>
<section class="section work">
    <div class="container">
        <div class="work__content grid_block">
            <!-- динамический title и subtitle -->
            <?php get_template_part('templates/logic_section/send_title'); ?>
            <div class="block_padding_60"></div>
            <div class="work__btm">
                <?php if (have_rows($repeater)):$i = 0; ?>
                    <?php while (have_rows($repeater)):the_row(); ?>
                        <div class="work__win grid_block">
                            <?php $icon = get_sub_field('icon'); ?>
                            <?php $title = get_sub_field('title'); ?>
                            <?php $sub_title = get_sub_field('sub_title'); ?>
                            <?php if ($icon): ?>
                                <div class="work__icon <?php echo esc_attr($icon); ?>">
                                    <i class="fontello-<?php echo esc_attr($icon); ?>"></i>
                                    <i class="work__ungle"><?php echo esc_html(++$i) ?></i>
                                </div>
                            <?php endif; ?>
                            <?php if ($title): ?>
                                <h4 class="sub_title"><?php echo esc_html($title); ?></h4>
                            <?php endif; ?>
                            <?php if ($sub_title): ?>
                                <p class="sub_subs"><?php echo esc_html($sub_title); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <div class="block_padding_40"></div>
            <?php get_template_part('templates/logic_section/send_rec'); ?>
            <div class="block_padding_60"></div>
            <?php get_template_part('templates/logic_section/send_btn'); ?>
        </div>
    </div>
</section>