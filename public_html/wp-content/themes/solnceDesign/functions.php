<?php
// Константы для удобства
define('CONTACT', get_template_directory_uri() . '/contact/');
define('MY_ASSETS', get_template_directory_uri() . '/assets');

if (!defined("GET_ACF_TITLE"))
    define('GET_ACF_TITLE', 'templates/logic_section/send_title');

require_once get_template_directory() . "/inc/scripts.php"; // подключение стили 
require_once get_template_directory() . "/inc/menu.php"; // подключение menu 
require_once get_template_directory() . "/inc/breadcrumbs.php"; // хлебный крошка не готова пока 
require_once get_template_directory() . '/amoCrm_ver_2/start_amo.php';
require_once get_template_directory() . "/inc/canvas_save_image.php"; // save image
require_once get_template_directory() . "/inc/get_field_contact_form7.php"; // save image

// тестовый нуждается сортировке  
require_once get_template_directory() . "/inc/breadcrumbs.php"; // хлебный крошка не готова пока  
// Исключаем категорию "Templates" из всех запросов товаров
require_once get_template_directory() . "/inc/test_func.php"; // хлебный крошка не готова пока  
require_once get_template_directory() . "/inc/cir_to_lat.php"; // 



require get_template_directory() . "/catalog_2/catalog_functions.php"; // catalog functions ajax 


