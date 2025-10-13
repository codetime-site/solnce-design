<?php
$layout = get_row_layout();
$title = get_sub_field('title');
$sub_title = get_sub_field('sub_title');
$color = get_sub_field('color');
$sub_color = get_sub_field('color_sub');

?>


<?php if ($layout && $layout == "hero"): ?>

    <?php if ($title): ?>
        <h1 class="hero__title" style="color:<?php echo esc_html($color ?: ''); ?>"><?php echo esc_html($title) ?></h1>
    <?php endif; ?>
    <?php if ($sub_title): ?>
        <h4 class="hero__subs" style="color:<?php echo esc_html($sub_color ?: ''); ?>">
            <?php echo esc_html($sub_title) ?>
        </h4>
    <?php endif; ?>

<?php // elseif ($layout && !($layout == "hero" || $layout == "rec" || $layout == "worker" || $layout == "order")): ?>
<?php elseif ($layout && !in_array($layout, ['hero', 'rec', 'worker', 'order','single_select_materials'], true)): ?>

    <div class="header_block">
        <?php if ($title): ?>
            <h2 class="title"><?php echo esc_html($title) ?></h2>
            <hr class="title__under">
            <div class="block_padding_20"></div>
        <?php endif; ?>
    </div>
    <?php if ($sub_title): ?>
        <div class="subs_block">
            <p class="subs"> <?php echo wp_kses_post($sub_title) ?></p>
        </div>
    <?php endif; ?>

<?php elseif ($layout && $layout == "rec"): ?>

    <?php if ($title): ?>
        <h2 class="title"><?php echo esc_html($title) ?></h2>
    <?php endif; ?>
    <?php if ($sub_title): ?>
        <p class="subs"> <?php echo wp_kses_post($sub_title) ?></p>
    <?php endif; ?>

<?php elseif ($layout && $layout == "worker"): ?>

    <?php if ($title): ?>
        <div class="profi__content">
            <h3 class="title"><?php echo esc_html($title) ?></h3>
        </div>
    <?php endif; ?>

<?php elseif ($layout && $layout == "order"): ?>

    <?php if ($title): ?>
        <h2 class="title"><?php echo esc_html($title) ?></h2>
    <?php endif; ?>
    <?php if ($sub_title): ?>
        <p class="subs_left"> <?php echo wp_kses_post($sub_title) ?></p>
    <?php endif; ?>

<?php endif; ?>