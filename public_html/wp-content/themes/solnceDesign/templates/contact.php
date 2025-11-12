<?php $img = get_sub_field('back_img'); ?>
<?php $title = get_sub_field('title'); ?>
<?php $contact_1 = get_sub_field('contact_1'); ?>
<?php $contact_2 = get_sub_field('contact_2'); ?>

<section class="section contact">
    <div class="container">
        <div class="contact__content grid_block">
            <?php if ($title || $img): ?>
                <div class="contact__img">
                    <?php if ($title): ?>
                        <h2 class="title"><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>
                    <?php if ($img): ?>
                        <img src="<?php echo esc_url($img); ?>" alt="this ContactImg">
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="contact__btm grid_block_two">
                <?php echo wp_kses_post($contact_1); ?>
                <?php echo wp_kses_post($contact_2); ?>
            </div>
        </div>
    </div>
</section>