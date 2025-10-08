<?php
$title = get_sub_field('title');
$sub_title = get_sub_field('sub_title');
?>

<section class="single_select_materials section">
    <div class="container">
        <div class="universal__content grid_block_two">
            <div class="universal__text">
                <h3 class="title"><?php echo esc_html($title); ?></h3>
                <p class="subs_left">
                    <?php echo wp_kses_post($sub_title); ?>
                </p>
                <?php // get_template_part("templates/logic_section/send_title"); ?>
                <div class="block_padding_40"></div>
            </div>

            <div class="single__left">
                <?php if (have_rows("rep_sel")): ?>
                    <?php while (have_rows("rep_sel")):
                        the_row(); ?>
                        <?php $img = get_sub_field('img'); ?>
                        <?php $titles = get_sub_field('title'); ?>
                        <div class="single__left_content">
                            <div class="single__img_list">
                                <img src="<?php echo esc_url($img); ?>" alt="">
                            </div>
                            <p><?php echo esc_html($titles); ?></p>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
<style>
    .single__img_list {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .single__left {
        display: flex;
        justify-content: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    .single__left_content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        background: white;
        border-radius: 16px;
        padding: 16px;
    }
</style>