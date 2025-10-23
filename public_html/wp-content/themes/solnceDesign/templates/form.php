
<?php $title = get_sub_field('title');
set_query_var("acf_title", $title);
    
?>
<section class="section form" id="form">
    <div class="container">
        <div class="form__content">
            <?php get_template_part('templates/logic_section/send_title'); ?>
            <div class="block_padding_40"></div>
            <div class="form__btn grid_block">
                <?php echo do_shortcode('[contact-form-7 id="3a74a92" title="main_form"]');// Вставка формы Contact Form 7 в шаблон ?>
            </div>  
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.querySelector('input[name="acf_title"]');
        if (input) input.value = "<?php echo esc_js($title); ?>";
    });
</script>