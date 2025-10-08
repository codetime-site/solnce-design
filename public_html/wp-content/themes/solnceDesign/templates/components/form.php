<!-- <form action="" class="form">
    <input type="text" id="names" name="names" placeholder="Ваше имя" required>
    <input type="tel" id="phones" name="phones" placeholder="Телефон" required>
    <input type="text" id="city" name="city" placeholder="Ваш город" required>
    <button type="submit" class="btn_win">Оставить заявку</button>
</form> -->
<?php
// Вставка формы Contact Form 7 в шаблон
echo do_shortcode('[contact-form-7 id="3a74a92" title="main_form"]');
?>

<!-- [text* your-name id:your-names class:names placeholder:"Ваше имя"]
[tel* your-phone id:your-phones class:phones placeholder:"Телефон"]
[text* your-city id:your-city class:city placeholder:"Ваш город"]
[submit "Оставить заявку"] -->