<?php
// Splide
add_action('wp_enqueue_scripts', "reg_scripts");
function reg_scripts()
{
    wp_enqueue_style('splide', "https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css", [], null);
    wp_enqueue_script('splide-js', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4/dist/js/splide.min.js', [], null, true);

    wp_enqueue_script('fabric-js', 'https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js', [], null, false);
    wp_enqueue_script('constructor-js', get_template_directory_uri() . '/assets/scripts/construct.js', ['fabric-js'], time(), true);

    // Передаём PHP-данные в JS
    wp_localize_script('constructor-js', 'wpData', [
        'templateUri' => get_template_directory_uri(),
        'ajaxUrl' => admin_url('admin-ajax.php'), // <-- без пробелов!
    ]);

    // Основные стили
    wp_enqueue_style('default-style', get_template_directory_uri() . '/assets/css/style.min.css', [], filemtime(get_template_directory() . '/assets/css/style.min.css'));

    // Свои скрипты (зависимость от splide)

    wp_enqueue_script('some_scripts', get_template_directory_uri() . '/assets/scripts/some.js', [], filemtime(get_template_directory() . '/assets/scripts/some.js'), true);


    wp_enqueue_style('fontello', get_template_directory_uri() . '/assets/fonts/fontello/css/fontello.css');

}