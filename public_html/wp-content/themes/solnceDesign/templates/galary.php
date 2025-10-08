<?php $repeater = "rep_galary"; ?>
<section class="splide helllo" aria-label="Splide Basic HTML Example">
    <div class="splide__track">
        <ul class="splide__list">
            <?php /*if (have_rows($repeater)): ?>
           <?php while (have_rows($repeater)):the_row(); */ ?>
            <?php $img = get_sub_field('img'); ?>
            <li class="splide__slide">
                <!-- <div class="slide_img"> -->
                    <img src="<?php echo esc_url($img); ?>" alt="">
                <!-- </div> -->
            </li>
            <?php /* endwhile; ?>
       <?php endif;*/ ?>
        </ul>
    </div>
</section>

<script>
    new Splide('.hello', {
        type: 'loop',
        drag: 'free',
        snap: true,
        perPage: 1,
    });
</script>