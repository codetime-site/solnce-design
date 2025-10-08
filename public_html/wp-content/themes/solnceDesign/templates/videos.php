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

<style>
    video.videos .splide__slide {
        display: flex;
        justify-content: center;
    }

    video {
        width: 100%;
        max-width: 600px;
    }

    /* Стилизация панели управления (работает в WebKit-браузерах) */
    video::-webkit-media-controls {
        background-color: rgba(0, 0, 0, 0.7);
        /* Фон панели управления */
        border-radius: 5px;
    }

    /* Стилизация кнопки воспроизведения */
    video::-webkit-media-controls-play-button {
        background-color: #ff0000;
        /* Цвет кнопки play */
        border-radius: 50%;
    }

    /* Стилизация ползунка громкости */
    video::-webkit-media-controls-volume-slider {
        background-color: #00ff00;
        /* Цвет ползунка */
    }

    /* Стилизация временной шкалы */
    video::-webkit-media-controls-timeline {
        background-color: #333;
        /* Цвет шкалы прогресса */
        0
    }

    .custom-controls {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    video button {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

   video button:hover {
        background-color: #0056b3;
    }

   video input[type="range"] {
        width: 100px;
        accent-color: #007bff;
        /* Цвет ползунка */
    }
</style>