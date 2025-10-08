<?php while (have_rows("flex_page")):
    the_row(); ?>
    <?php if (get_row_layout() === "hero"): ?>
        <?php get_template_part('templates/hero'); ?>

    <?php elseif (get_row_layout() === "connect"): ?>
        <?php get_template_part('templates/flex/flex_single'); ?>

    <?php elseif (get_row_layout() === "work_step"): ?>
        <?php get_template_part('templates/work'); ?>

    <?php elseif (get_row_layout() === "our_project"): ?>
        <?php get_template_part('templates/project'); ?>

    <?php elseif (get_row_layout() === "reviews"): ?>
        <?php get_template_part('templates/reviews'); ?>

    <?php elseif (get_row_layout() === "service"): ?>
        <?php get_template_part('templates/service'); ?>

    <?php elseif (get_row_layout() === "order"): ?>
        <?php get_template_part('templates/universal'); ?>

    <?php elseif (get_row_layout() === "single_galary"): ?>
        <?php get_template_part('templates/single_galary'); ?>

    <?php elseif (get_row_layout() === "video"): ?>
        <?php get_template_part('templates/videos'); ?>

    <?php elseif (get_row_layout() === "rec"): ?>
        <?php get_template_part('templates/rec'); ?>

    <?php elseif (get_row_layout() === "order"): ?>
        <?php get_template_part('templates/hero'); ?>

    <?php elseif (get_row_layout() === "worker"): ?>
        <?php get_template_part('templates/professionals'); ?>

    <?php elseif (get_row_layout() === "maps"): ?>
        <?php get_template_part('templates/maps'); ?>

    <?php elseif (get_row_layout() === "contact"): ?>
        <?php get_template_part('templates/contact'); ?>

    <?php elseif (get_row_layout() === "form"): ?>
        <?php get_template_part('templates/form'); ?>

    <?php elseif (get_row_layout() === "galary"): ?>
        <?php get_template_part('templates/galaryImg'); ?>

    <?php elseif (get_row_layout() === "postforproduct"): ?>
        <?php get_template_part('templates/galary'); ?>
        
        <?php elseif (get_row_layout() === "single_select_materials"): ?>
            <?php get_template_part('templates/single_select_materials'); ?>

    <?php endif; ?>
<?php endwhile; ?>