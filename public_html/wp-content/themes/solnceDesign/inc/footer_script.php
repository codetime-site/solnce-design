<?php

$map1 = get_query_var('maps_1');
$map2 = get_query_var('maps_2');


if ($map1 || $map2) {
    // Проверяем, зарегистрирован ли скрипт
    if (wp_script_is('some_scripts', 'registered') || wp_script_is('some_scripts', 'enqueued')) {
        wp_localize_script('some_scripts', 'wpMaps', [
            'maps_1' => $map1,
            'maps_2' => $map2,
        ]);
    }
}
