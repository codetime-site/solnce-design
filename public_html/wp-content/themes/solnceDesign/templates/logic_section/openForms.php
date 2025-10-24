<div id="myModal" class="modal-backdrop">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Оставьте свою заявку</h2>
        <?php echo do_shortcode('[contact-form-7 id="3a74a92" title="main_form" product_id="' . get_the_ID() . '"]');// Вставка формы Contact Form 7 в шаблон ?>

    </div>
</div>
<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.querySelector('input[name="acf_title"]');
        if (input) input.value = "<?php// echo esc_js($title); ?>";
    });
</script> -->
