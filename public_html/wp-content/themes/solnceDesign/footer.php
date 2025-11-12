<?php get_template_part('templates/contact_form') ?>

<footer class="footer" id="contacts">
    <div class="container">
        <div class="footer__content">

            <div class="footer__logo">
                <?php get_template_part('templates/contacts/logo_white'); ?>
                <?php get_template_part('templates/contacts/under_logo'); ?>
                <p class="footer__subs">Профессиональные интерактивные решения с 2015 года. Создаем комфортные и
                    стильные
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
                    <p><span>🏢</span> г. Сургут, ул. Профсоюзов 11<br>ТЦ "Агора 3 этаж"<br>г. Уфа, ул. Менделеева
                        158,<br>ВДНХ-ЭКСПО, 1 этаж</p>
                </div>
            </div>
        </div>
    </div>

</footer>
<?php wp_footer(); ?>

<script>
  (function () {
    // Журнал для отладки — оставь временно, чтобы видеть что происходит
    function log(...args) {
      if (window.console) console.log('[ModalThumb]', ...args);
    }

    // Ищем все контейнеры с мини-галереями
    const thumbnailContainers = document.querySelectorAll('.thumbnail-slider');

    if (!thumbnailContainers.length) {
      log('Не найдено .thumbnail-slider — проверь HTML или инициализацию Splide.');
      return;
    }

    // Получаем модалку
    const modal = document.getElementById('imgModal');
    const modalImg = document.getElementById('modalImage');
    const closeBtn = document.getElementById('closeImgModal');

    if (!modal || !modalImg || !closeBtn) {
      log('Не найдена разметка модалки (imgModal / modalImage / closeImgModal).');
      return;
    }

    // Вспомогательная: вытянуть URL картинки из li (поддерживает <img>, data-src, background-image)
    function resolveThumbSrc(slideEl) {
      if (!slideEl) return null;

      // 1) если есть <img>
      const img = slideEl.querySelector('img');
      if (img) {
        // поддержим lazy атрибуты common
        return img.getAttribute('src') || img.getAttribute('data-src') || img.getAttribute('data-lazy') || img.src || null;
      }

      // 2) если изображение задано как background-image на элементе (или inline style)
      const bg = window.getComputedStyle(slideEl).backgroundImage;
      if (bg && bg !== 'none') {
        // background-image: url("...") -> надо вырезать URL
        const m = bg.match(/url\(["']?(.*?)["']?\)/);
        if (m) return m[1];
      }

      // 3) пробуем data-атрибуты
      const dataSrc = slideEl.dataset.src || slideEl.dataset.thumbnail || null;
      if (dataSrc) return dataSrc;

      return null;
    }

    // Открыть модалку с src
    function openModalWithSrc(src, triggerEl) {
      if (!src) {
        log('src не найден для миниатюры', triggerEl);
        return;
      }
      // убрать фокус, чтобы не получать aria-hidden warning
      try { document.activeElement && document.activeElement.blur(); } catch(e){}

      modalImg.setAttribute('src', src);
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
      // ставим фокус на кнопку закрытия для A11y
      closeBtn.focus();
    }

    // Делегируем клик на контейнеры (надёжнее для клонированных слайдов)
    thumbnailContainers.forEach(container => {
      container.addEventListener('click', function (e) {
        // ищем ближайший .splide__slide
        const slide = e.target.closest('.splide__slide');
        if (!slide || !container.contains(slide)) return;

        // игнорируем если клик на управляющие стрелки и т.п.
        // (если стрелки имеют класс splide__arrow, то они не должны попадать)
        if (e.target.closest('.splide__arrow')) return;

        const src = resolveThumbSrc(slide);
        openModalWithSrc(src, slide);
      }, false);
    });

    // Закрытие по кресту
    closeBtn.addEventListener('click', function () {
      modal.classList.remove('active');
      document.body.style.overflow = '';
      // возврат фокуса не обязателен, можно вернуть его на первый видимый мини-элемент
    });

    // Закрытие кликом по фону
    modal.addEventListener('click', function (e) {
      if (e.target === modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
      }
    });

    // Закрытие клавишей Esc
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && modal.classList.contains('active')) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
      }
    });

    log('Modal thumb handler initialized for', thumbnailContainers.length, 'containers');
  })();
</script>


</body>

</html>