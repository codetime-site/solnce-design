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
                        <?php $img = get_sub_field('img'); ?>
                        <?php $btn = get_sub_field('btn'); ?>
                        <?php $icon = get_sub_field('icon'); ?>

                        <div class="win">
                            <div class="win__img">
                                <?php if ($btn): ?>
                                    <button type="button" class="win__link toggle-form" style="padding: 10px 20px; background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; border-radius: 25px; font-size: 16px; cursor: pointer; transition: transform 0.2s;"><?php echo esc_html($btn); ?></button>
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

<!-- Modal for service form -->
<div id="service-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background: white; padding: 30px; border-radius: 15px; max-width: 500px; width: 90%;">
        <h3 style="margin-bottom: 20px; color: #333;">Оставить заявку</h3>
        <form method="post">
            <div style="margin-bottom:15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Имя:</label>
                <input type="text" name="service-name" placeholder="Ваше имя" required style="width:100%; padding:12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
            </div>
            <div style="margin-bottom:15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Телефон:</label>
                <input type="tel" name="service-phone" placeholder="Ваш телефон" required style="width:100%; padding:12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
            </div>
            <div style="margin-bottom:20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Город:</label>
                <input type="text" name="service-city" placeholder="Ваш город" required style="width:100%; padding:12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
            </div>
            <button type="submit" style="padding:12px 25px; background: linear-gradient(135deg, #667eea, #764ba2); color:white; border:none; border-radius: 25px; font-size: 16px; cursor: pointer;">Отправить</button>
            <button type="button" id="close-modal" style="padding:12px 25px; background: #f8f9fa; color: #333; border: 1px solid #ddd; border-radius: 25px; font-size: 16px; cursor: pointer; margin-left: 10px;">Отмена</button>
        </form>
    </div>
</div>

<script>

    document.querySelectorAll(".win").forEach(function (item) {
        const link = item.querySelector(".win__link"); // Находим .win__link внутри текущего .win__img

        // Show modal on button click
        if (link) {
            link.addEventListener("click", function (e) {
                e.preventDefault();
                const modal = document.getElementById('service-modal');
                modal.style.display = 'flex';
            });
        }
    });

    // Close modal
    document.getElementById('close-modal').addEventListener('click', function () {
        document.getElementById('service-modal').style.display = 'none';
    });

    // Close modal on outside click
    document.getElementById('service-modal').addEventListener('click', function (e) {
        if (e.target === this) {
            this.style.display = 'none';
        }
    });
</script>