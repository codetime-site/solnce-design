<section class="section videos">
    <div class="container">
        <div class="block_padding_60"></div>
        <?php get_template_part("templates/logic_section/send_title") ?>
        <div class="block_padding_40"></div>
        <div class="splide splide_video" id="splide_video" role="group" aria-label="Splide Video Slider">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php if (have_rows('rep_video')): ?>
                        <?php while (have_rows('rep_video')):
                            the_row(); ?>
                            <?php $video = get_sub_field('vid'); // Получаем подполе video ?>
                            <?php $video_url = esc_url($video); ?>
                            <?php if ($video_url): ?>
                                <li class="splide__slide">
                                    <video class="code_videos" id="backgroundVideo" autoplay loop muted="false" controls>
                                        <source src="<?php echo $video_url; ?>" type="video/mp4">
                                        Ваш браузер не поддерживает видео.
                                    </video>
                                </li>
                            <?php else: ?>
                                <li class="splide__slide">
                                    <p>Видео не загружено.</p>
                                </li>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <li class="splide__slide">
                            <p>Видео отсутствуют.</p>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="block_padding_40"></div>
            </div>
        </div>
    </div>
</section>
