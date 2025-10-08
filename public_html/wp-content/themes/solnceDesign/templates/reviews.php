<?php $repeater = "rep_win"; ?>
<section class="section project">
    <div class="container">
        <div class="project__content grid_block">
            <!-- динамический title и subtitle -->
            <?php get_template_part('templates/logic_section/send_title'); ?>
            <div class="block_padding_60"></div>
            <div class="rev__block">
                <?php if (have_rows($repeater)): ?>
                    <?php while (have_rows($repeater)):the_row(); ?>
                        <?php
                        $title = get_sub_field('title');
                        $sub_title = get_sub_field('sub_title');
                        $rep_win = get_sub_field('rep_win');
                            ?>
                        <div class="rev__win">
                            <?php if ($title): ?>
                                <div class="win__text_up">
                                    <span class="rev_icon"><?php echo esc_html(mb_substr($title, 0, 1, 'UTF-8')); ?></span>
                                    <div class="win__text_left">
                                        <p class="subs_bold"><?php echo esc_html($title); ?></p>
                                        <span>✨✨✨✨✨</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($sub_title): ?>
                                <p class="subs"> <?php echo esc_html($sub_title); ?></p>
                            <?php endif; ?>
                            <?php if ($rep_win): ?>
                                <p class="subs_bold_down"><?php echo esc_html($rep_win); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>