<?php
// Splide
wp_enqueue_style('splide', "https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css", [], null);
wp_enqueue_script('splide-js', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4/dist/js/splide.min.js', [], null, true);

// Основные стили
wp_enqueue_style('default-style', get_template_directory_uri() . '/assets/css/style.min.css', [], filemtime(get_template_directory() . '/assets/css/style.min.css'));

// Свои скрипты (зависимость от splide)

wp_enqueue_script('some_scripts', get_template_directory_uri() . '/assets/scripts/some.js', [], filemtime(get_template_directory() . '/assets/scripts/some.js'), true);

// Fontello
wp_enqueue_style('fontello', get_template_directory_uri() . '/assets/fonts/fontello/css/fontello.css');