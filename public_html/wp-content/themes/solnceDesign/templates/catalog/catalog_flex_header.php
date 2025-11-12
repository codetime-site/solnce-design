<?php if (have_rows("flex_page")):
    while (have_rows("flex_page")): the_row() ?>
        <?php if (get_row_layout() === "hero"): ?>
            <?php get_template_part('templates/hero'); ?>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>