<?php $rep_list_title = get_sub_field('rep_list_title'); ?>
<?php $img = get_sub_field('img'); ?>
<?php $way = get_sub_field('way'); ?>
<?php $logic = get_sub_field('logic'); ?>
<?php $rep_order = get_sub_field('rep_order'); ?>
<?php $query_title = get_sub_field('query_title'); ?>
<?php $rep_query = get_sub_field('rep_query'); ?>
<?php $rec_title = get_sub_field('rec_title'); ?>
<?php $rec_sub_title = get_sub_field('rec_sub_title'); ?>
<?php $btn = get_sub_field('btn');

?>

<section class="section universal">
    <div class="container">
        <div class="universal__content grid_block_two" style="direction:<?php echo esc_attr($way); ?>;">
            <div class="universal__text grid_block"
                style='direction:<?php echo esc_attr($way = "rtl" ? "ltr" : ""); ?>'>
                <?php get_template_part('templates/logic_section/send_title'); ?>
                <?php if ($rep_list_title): ?>
                    <div class="block_padding_20"></div>
                    <p class="subs_bold"> <?php echo esc_html($rep_list_title); ?></p>
                <?php endif; ?>
                <?php if ($rep_order): ?>
                    <p class="subs_bold"> <?php echo wp_kses_post($rep_order); ?></p>
                <?php endif; ?>
                <?php if ($query_title): ?>
                    <div class="block_padding_20"></div>
                    <p class="subs_bold"> <?php echo esc_html($query_title); ?></p>
                <?php endif; ?>
                <?php if ($rep_query): ?>
                    <ul class="sub_mebel grid_block_two">
                        <?php echo wp_kses_post($rep_query); ?>
                    </ul>
                <?php endif; ?>
                <div class="block_padding_40"></div>
                <?php if ($logic == "no_forms"): ?>
                    <?php if ($rec_title): ?>
                        <div class="sub_rec grid_block">
                            <div class="win__text_up">
                                <i class="fontello-phone"></i>
                                <p class="subs_bold"> <?php echo esc_html($rec_title); ?></p>
                            </div>
                            <p class="subs"><?php echo esc_html($rec_sub_title); ?></p>
                            <button class="btn_win btn openModalBtn" data-title="<?php the_sub_field('title'); ?>"
                                data-img="<?php echo $img['url']; ?>"
                                data-link="<?php the_permalink(); ?>"><?php echo esc_html($btn); ?> </button>
                        </div>
                    <?php endif; ?>
                <?php elseif ($logic == "with_forms"): ?>

                    <?php echo do_shortcode('[contact-form-7 id="7b62910" title="universal"]'); ?>
                <?php endif; ?>
            </div>

            <div class="universal__img">
                <?php if ($img): ?>
                    <div class="img_block"
                        style="background-image:url(<?php echo esc_url($img["sizes"]['medium_large']); ?>)">
                        <?php /*?>
                     <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_html($rep_list_title); ?>">
                     <?php */ ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>