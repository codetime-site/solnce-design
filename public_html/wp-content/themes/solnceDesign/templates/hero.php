<?php
$img = get_sub_field('back_img');
$btn = get_sub_field('btn');
$className = get_sub_field('smallbig') ? "hero__backImg_light" : null;
$class_color = get_sub_field('catalog_color') ?: null;
?>

<section class="hero section" id="hero">
    <?php if ($img): ?>
        <div class="hero__backImg <?php echo esc_attr($className); ?>"
            style="background:<?php echo esc_attr($class_color) ?>">
            <img src="<?php echo esc_url($img['sizes']['large']) ?>" alt="background image">
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="hero__content grid_block">
            <?php get_template_part('templates/logic_section/send_title'); ?>

            <?php if ($btn): ?>
                <button class="btn btn_sec openModalBtn" id="openModalBtn" data-title="<?php the_sub_field('title'); ?>"
                    data-img="<?php echo $img['url']; ?>" data-link="<?php the_permalink(); ?>">
                    <?php echo esc_html($btn) ?>
                    <i class="fontello-arrows-right-line1"></i>
                </button>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php  get_template_part('templates/modal_form'); ?>

<script>
document.addEventListener("DOMContentLoaded", startModal);

    function startModal() {
        console.log('startModal подключен');
        const modal = document.getElementById('myModal');
        const btns = document.querySelectorAll('.openModalBtn');
        const closeBtn = document.querySelector('#myModal .close-btn');

        if (!btns.length || !modal) return;

        btns.forEach(item => {
            item.onclick = function () {
                const form = document.querySelector('.wpcf7 form');
                if (form) {
                    form.querySelector('[name="acf_title"]').value = item.dataset.title || '';
                    form.querySelector('[name="acf_image"]').value = item.dataset.img || '';
                    form.querySelector('[name="acf_link"]').value = item.dataset.link || '';
                }

                modal.style.display = "flex";
                setTimeout(() => {
                    modal.classList.add('modal-show');
                }, 50);
            };
        });

        function closeModal() {
            modal.classList.remove('modal-show');
            setTimeout(() => {
                modal.style.display = "none";
            }, 300);
        }

        if (closeBtn) closeBtn.onclick = closeModal;

        window.onclick = function (event) {
            if (event.target === modal) closeModal();
        };

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && modal.classList.contains('modal-show')) {
                closeModal();
            }
        });
    }

</script>