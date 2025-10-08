<?php $images = get_sub_field('images'); ?>

<section class="single_galary">
    <div class="container">

        <?php if ($images): ?>
            <div id="splide" class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php $chunks = array_chunk($images, 4);
                        foreach ($chunks as $chunk): ?>
                            <li class="splide__slide">
                                <div class="img_template">
                                    <?php foreach ($chunk as $image): ?>
                                        <div class="slide_grid">
                                            <img src="<?php echo esc_url($image); ?>" alt="">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Splide('#splide', {
            type: 'loop',
            // perPage: 2,
            gap: 50,
            focus: 'center',
            autoplay: true,
            interval: 2000, // смена каждые 1 секунду
            // speed: 800,
            rewind: true,
            rewindSpeed: 1000,
            pauseOnFocus: false,
            arrows: false,
            pagination: false,
        }).mount();
    });
</script>