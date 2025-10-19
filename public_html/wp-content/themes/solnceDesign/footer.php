<div class="block_padding_40"></div>
<?php get_template_part('templates/contact_form') ?>
<footer class="footer" id="contacts">
    <div class="container">
        <div class="footer__content">

            <div class="footer__logo">
                <?php get_template_part('templates/contacts/logo_white'); ?>
                <?php get_template_part('templates/contacts/under_logo'); ?>
                <p class="footer__subs">Профессиональные интерактивные решения с 2015 года. Создаем комфортные и стильные
                    пространства для
                    жизни и работы</p>
            </div>

            <div class="footer__left">
                <div class="footer__center">
                    <h3>Навигация</h3>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'header_menu',
                        'container' => 'nav',
                        'container_class' => 'footer__menu menu',
                        'container_id' => 'footer__menu',
                        'menu_class' => 'menu',
                        'echo' => true,
                        'items_wrap' => '<ul id="%1$s" class="menu__list %2$s">%3$s</ul>',
                        'depth' => 1,
                        'walker' => '',
                    ]);
                    ?>
                </div>
                <div class="footer__contact">
                    <h3>Контакты</h3>
                    <p><span>☎</span> +7 (3462) 123-45-67<br>Звонок бесплатно</p>
                    <p><span>📧</span> <a href="mailto:info@solntse-design.ru">info@solntse-design.ru</a></p>
                    <p><span>🏢</span> г. Сургут, ул. Профсоюзов 11<br>ТЦ "Агора 3 этаж"<br>г. Уфа, ул. Менделеева 158,<br>ВДНХ-ЭКСПО, 1 этаж</p>
                </div>
            </div>
        </div>
    </div>

</footer>
<?php wp_footer(); ?>
</body>

</html>