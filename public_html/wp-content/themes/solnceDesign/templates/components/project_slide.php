<?php $image = $args ?>

<div id="main-slider" class="splide main-slider" aria-label="project">
    <div class="splide__track">
        <ul class="splide__list">

            <?php foreach ($image as $image1): ?>
                <li class="splide__slide">
                    <div class="win__img">
                        <img src="<?php echo $image1; ?>">
                    </div>
                </li>
            <?php endforeach; ?>

        </ul>
    </div>
</div>

<div class="min__pic">
    <div id="thumbnail-slider" class="splide thumbnail-slider" aria-label="Thumbnail Slider">
        <div class="splide__track">
            <ul class="splide__list">

                <?php foreach ($image as $image1): ?>
                    <li class="splide__slide">
                        <img src="<?php echo esc_url($image1); ?>" alt="">
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>
    </div>
</div>