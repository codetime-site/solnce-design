<?php $repeater = "rep_step"; ?>

<section class="section service">
    <div class="container">
        <div class="service__content grid_block">
            <?php $subs = get_sub_field('subs_title'); ?>
            <!-- динамический title и subtitle -->
            <?php get_template_part('templates/logic_section/send_title'); ?>
            <div class="block_padding_20"></div>
            <h4 class="title"><?php echo esc_html($subs); ?></h4>
            <div class="block_padding_40"></div>
            <div class="service__btm grid_block_two">
                <?php if (have_rows($repeater)): ?>
                    <?php while (have_rows($repeater)):
                        the_row(); ?>
                        <?php $title = get_sub_field('title'); ?>
                        <?php $sub_title = get_sub_field('sub_title'); ?>
                        <?php $img = get_sub_field('img'); ?>
                        <?php $btn = get_sub_field('btn'); ?>
                        <?php $icon = get_sub_field('icon'); ?>

                        <div class="win">
                            <div class="win__img">
                                <?php if ($btn): ?>
                                    <a href="" class="win__link"><?php echo esc_html($btn); ?></a>
                                <?php endif; ?>
                                <?php if ($img): ?>
                                    <img src="<?php echo esc_url($img); ?>" alt="">
                                <?php endif; ?>
                            </div>

                            <div class="win__text grid_block">
                                <div class="win__text_up">
                                    <?php if ($icon): ?>
                                        <i class="fontello-<?php echo esc_attr($icon); ?> icon_type1"></i>
                                    <?php endif; ?>
                                    <?php if ($title): ?>
                                        <h3><?php echo esc_html($title); ?></h3>
                                    <?php endif; ?>
                                </div>
                                <?php if ($sub_title): ?>
                                    <?php echo esc_html($sub_title); ?>
                                <?php endif; ?>
                            </div>
                        </div>

                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <div class="block_padding_40"></div>
            <?php get_template_part('templates/logic_section/send_rec'); ?>
            <!-- <p class="subs">Обращаясь в Солнце Дизайн, вы получаете комплексный подход, персонализированное решение и безупречный
                результат.</p> -->
            <div class="block_padding_40"></div>
        </div>
    </div>
</section>



<script>

    document.querySelectorAll(".win").forEach(function (item) {
        const link = item.querySelector(".win__link"); // Находим .win__link внутри текущего .win__img
        item.addEventListener("mouseover", function () {
            if (link) {
                link.style.display = "block"; // Показываем ссылку
            }
        });
        item.addEventListener("mouseout", function () {
            if (link) {
                link.style.display = "none"; // Скрываем ссылку
            }
        });
    });
</script>