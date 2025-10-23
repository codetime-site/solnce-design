<?php
$img = get_sub_field('back_img');
$className = get_sub_field('smallbig') ? "hero__backImg_light" : null;
$class_color = get_sub_field('catalog_color') ?: null;


?>



<section class="hero section" id="hero">
    <?php if ($img): ?>
        <div class="hero__backImg <?php echo esc_attr($className); ?>" style="background:<?php echo esc_attr($class_color)?>">
            <img src="<?php echo esc_url($img['sizes']['large']) ?>" alt="background image">
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="hero__content grid_block">
            <?php get_template_part('templates/logic_section/send_title'); ?>
            <?php get_template_part('templates/logic_section/send_btn'); ?>
        </div>
    </div>
</section>