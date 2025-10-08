<?php $img = get_sub_field('back_img'); ?>
<?php $title = get_sub_field('title'); ?>
<?php $contact_1 = get_sub_field('contact_1'); ?>
<?php $contact_2 = get_sub_field('contact_2'); ?>

<section class="section contact">
    <div class="container">
        <div class="contact__content grid_block">
            <div class="contact__img">
                <h2 class="title"><?php echo esc_html($title); ?></h2>
                <img src="<?php echo esc_url($img); ?>" alt="">
            </div>
            <div class="contact__btm grid_block_two">
                <?php echo wp_kses_post($contact_1); ?>
                <?php echo wp_kses_post($contact_2); ?>
            </div>
        </div>
    </div>
</section>


<?php/*

образец для контакт
<ul class="contact__cont">
<li class="contact__main_list">ИП Идрисов А.Р.</li>
<li class="block_padding_20"></li>
<li class="contact__main_list"><i class="fontello-map-placeholder1"></i>Адрес: г
<ul class="sec_list">
<li>Сургут, ул. Профсоюзов 11, ТЦ Агора, 3 этаж</li>
</ul>
</li>
<li class="contact__main_list"><i class="fontello-map-placeholder1"></i>Время работы:
<ul class="sec_list">
<li>Пн-пт с 10:00 до 19:00</li>
<li>Сб-вс с 10:00 до 18:00</li>
</ul>
</li>
<li class="contact__main_list"><i class="fontello-map-placeholder1"></i>E-mail:
<ul class="sec_list">
<li class="sec_list--red">asasasasasasasasasa</li>
</ul>
</li>
<li class="contact__main_list"><i class="fontello-map-placeholder1"></i>Телефон:
<ul class="sec_list">
<li>Салон технического освещения и натяжных потолков:</li>
<li class="sec_list--red">+7 (982) 207-20-62</li>
<li>Салон мебели, декора и декоративного освещения:</li>
<li class="sec_list--red">+7 (929) 294-81-81</li>
</ul>
</li>
</ul>
    */ ?>