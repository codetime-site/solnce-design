<?php $repeater = "rep_step"; ?>

<?php
// Обработка формы сервиса для отправки в AmoCRM
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['service-phone'])) {
    $name = sanitize_text_field($_POST['service-name'] ?? '');
    $phone = sanitize_text_field($_POST['service-phone']);
    $city = sanitize_text_field($_POST['service-city'] ?? '');
    $product_url = get_permalink(); // Ссылка на страницу

    if ($phone) {
        $res = amocrm_create_lead_with_contact($name ?: 'Без имени', $phone, '', $city, $product_url);
        if (is_wp_error($res)) {
            error_log('amoCRM error from service: ' . $res->get_error_message());
        } else {
            error_log('amoCRM create lead response from service: ' . print_r($res, true));
        }
    }
}
?>

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
                        <?php $img = get_sub_field('img');
                        $images = $img['sizes']['medium_large'];
                        ?>
                        <?php $btn = get_sub_field('btn'); ?>
                        <?php $icon = get_sub_field('icon'); ?>


                        <div class="win">
                            <div class="win__img">
                                <?php if ($btn): ?>
                                    <!-- <button type="button" class="win__link openModalBtn"></button> -->

                                    <button class="win__link openModalBtn" data-title="<?php echo $title; ?>"
                                        data-img="<?php echo $img['url']; ?>" data-link="<?php the_permalink(); ?>">
                                        <?php echo esc_html($btn); ?>
                                    </button>
                                <?php endif; ?>
                                <?php if ($images): ?>
                                    <img src="<?php echo esc_url($images); ?>" alt="">
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

 <?php get_template_part('templates/modal_form'); ?>
